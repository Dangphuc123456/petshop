<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderPaidMail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')->get();

        $userId = Auth::guard('customer')->id();
        $cart = session('cart_' . $userId, []);
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('User.checkout', compact(
            'cart',
            'totalPrice',
            'dogCategories',
            'catCategories',
            'accessoryCategories'
        ));
    }


    public function payment(Request $request)
    {
        DB::beginTransaction();
        try {
            // Tạo đơn hàng
            $order = new Order();
            $order->customer_id  = Auth::check() ? Auth::id() : null;
            $order->customer_name = $request->customer_name;
            $order->total_amount = $request->total_amount;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->postal_code = $request->postal_code;
            $order->email = $request->email;
            $order->payment = $request->payment;
            $order->status = 'Chờ Xác Nhân';
            $order->save();

            foreach ($request->order_items as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id   = $order->order_id;
                $orderItem->pet_id     = $item['pet_id'];
                $orderItem->quantity   = $item['quantity'];
                $orderItem->price      = $item['price'];
                $orderItem->image_url  = $item['image_url'];
                $orderItem->description = $item['name'];
                $orderItem->save();

                // Trừ kho nếu thanh toán là COD
                if ($request->payment === 'Cod') {
                    $product = Pet::find($item['pet_id']);
                    if ($product && $product->quantity_in_stock >= $item['quantity']) {
                        $product->quantity_in_stock -= $item['quantity'];
                        $product->save();
                    }
                }
            }
            DB::commit();

            // Nếu chọn VNPAY thì chuyển hướng đến cổng thanh toán
            if ($request->payment === 'vnpay') {
                return $this->redirectToVNPay($order);
            }

            // Xóa giỏ hàng trong session (nếu có)
            $userId = Auth::guard('customer')->id();
            session()->forget('cart_' . $userId);

            return redirect()->route('order.success', $order->order_id)
                ->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }


    public function redirectToVNPay(Order $order)
    {
        $vnp_TmnCode    = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_Url        = env('VNP_URL');
        $vnp_Returnurl  = env('VNP_RETURN_URL');

        $txnRef = $order->order_id . '_' . time();

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => intval($order->total_amount) * 100,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => request()->ip(),
            "vnp_Locale"     => "vn",
            "vnp_OrderInfo"  => 'Thanh toán đơn hàng #' . $order->order_id,
            "vnp_OrderType"  => "billpayment",
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $txnRef,
        ];

        ksort($inputData);

        $hashData = '';
        $query    = '';
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
            $query    .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');
        $query    = rtrim($query, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpUrl     = $vnp_Url . '?' . $query . '&vnp_SecureHash=' . $secureHash;

        return redirect($vnpUrl);
    }


    public function handleVNPayReturn(Request $request)
    {
        $vnpHashSecret = env('VNP_HASH_SECRET');
        $data = $request->all();

        $vnpSecureHash = $data['vnp_SecureHash'] ?? '';
        unset($data['vnp_SecureHash'], $data['vnp_SecureHashType']);

        $filtered = [];
        foreach ($data as $key => $val) {
            if (str_starts_with($key, 'vnp_')) {
                $filtered[$key] = $val;
            }
        }

        ksort($filtered);
        $hashData = '';
        foreach ($filtered as $key => $val) {
            $hashData .= urlencode($key) . '=' . urlencode($val) . '&';
        }

        $hashData = rtrim($hashData, '&');
        $calcHash = hash_hmac('sha512', $hashData, $vnpHashSecret);

        $responseCode = $request->get('vnp_ResponseCode');
        $txnRef       = $request->get('vnp_TxnRef', '');
        $orderId      = intval(strtok($txnRef, '_'));

        if ($calcHash === $vnpSecureHash && $responseCode == '00') {
            $order = Order::find($orderId);

            // ✅ Chỉ cập nhật trạng thái thanh toán
            if ($order && !$order->stock_deducted) {
                $order->stock_deducted = true; // Nếu muốn dùng flag này để tránh xử lý lại
                $order->status = 'Đã thanh toán';
                $order->save();
            }

            // ✅ Xóa giỏ hàng sau thanh toán
            $userId = Auth::guard('customer')->id();

            if ($userId) {
                session()->forget('cart_' . $userId);
            }

            return redirect()->route('order.success', $orderId)
                ->with('success', 'Thanh toán VNPAY thành công!');
        }

        return redirect()->route('order.failure')
            ->with('error', 'Thanh toán VNPAY thất bại hoặc bị giả mạo.');
    }


    public function paymentSuccess($order_id)
    {

        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')->get();
        $order = Order::where('order_id', $order_id)->first(); // Dùng order_id thay vì id

        if (!$order) {
            return abort(404, 'Không tìm thấy đơn hàng.');
        }
        $Pets = Pet::inRandomOrder()->limit(15)->get();
        return view('User.order_success', compact('order', 'dogCategories', 'catCategories', 'accessoryCategories', 'Pets'));
    }

    public function paymentFailure($order_id)
    {

        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')->get();
        $order = Order::where('order_id', $order_id)->first(); // Dùng order_id thay vì id

        if (!$order) {
            return abort(404, 'Không tìm thấy đơn hàng.');
        }
        $Pets = Pet::inRandomOrder()->limit(15)->get();
        return view('User.order_failure', compact('order', 'dogCategories', 'catCategories', 'accessoryCategories', 'Pets'));
    }
}
