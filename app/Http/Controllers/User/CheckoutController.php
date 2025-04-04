<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('User.checkout', compact('cart', 'totalPrice', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
    public function payment(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.userslogin')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        // Lấy thông tin khách hàng
        $user = Auth::guard('customer')->user();
        $customerId = $user->id;

        // Tạo đơn hàng mới
        $order = new Order();
        $order->customer_id = $customerId;
        $order->customer_name = $request->customer_name;
        $order->email = $request->email;
        $order->country = $request->country;
        $order->postal_code = $request->postal_code;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->payment = $request->payment;
        $order->total_amount = $request->total_amount;
        $order->status = 'Chờ xác nhận'; // Trạng thái mặc định là pending
        $order->save();

        // Tạo bản ghi trong bảng `payments`
        foreach ($request->order_items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->order_id;
            $orderItem->pet_id = $item['pet_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->description = $item['name'];
            $orderItem->image_url = $item['image_url'];
            $orderItem->save();

            // Trừ số lượng thú cưng trong kho
            $product = Pet::find($item['pet_id']);
            if ($product && $product->quantity_in_stock >= $item['quantity']) {
                $product->quantity_in_stock -= $item['quantity'];
                $product->save();
            }
        }
        $payment = new Payment();
        $payment->order_id = $order->order_id;
        $payment->payment_method = $request->payment;
        $payment->transaction_id = $request->transaction_id ?? null;
        $payment->status = 'pending'; // Chờ xác nhận thanh toán
        $payment->save();
        // Xóa giỏ hàng trong session
        $request->session()->forget(['cart', 'Cart_TotalQuantity', 'Cart_TotalPrice']);

        return redirect()->route('User.checkout', $order->order_id)->with('success', 'Đặt hàng thành công, vui lòng kiểm tra đơn hàng!');
    }


    /**
     * Xử lý thanh toán online qua MoMo hoặc ZaloPay
     */
    private function processOnlinePayment($method, $order)
    {
        if ($method === 'momo') {
            return $this->generateMomoPaymentUrl($order);
        } elseif ($method === 'zalopay') {
            return $this->generateZaloPayPaymentUrl($order);
        }
        return route('User.checkout.failure');
    }

    private function generateMomoPaymentUrl($order)
    {
        return "https://test-payment.momo.vn/gw_payment/redirect?id=" . $order->order_id;
    }

    private function generateZaloPayPaymentUrl($order)
    {
        return "https://sandbox.zalopay.vn/payment?id=" . $order->order_id;
    }
}
