<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $userId = Auth::guard('customer')->id(); // Lấy ID khách hàng

        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        // Lấy giỏ hàng từ session theo user ID
        $cart = session()->get('cart_' . $userId, []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('User.cart', compact('cart', 'total', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }


    public function addToCart(Request $request, $pet_id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Bạn cần đăng nhập để mua hàng.');
        }
        $userId = Auth::guard('customer')->id();
        $product = Pet::where('pet_id', $pet_id)->firstOrFail();

        $cart = session()->get('cart_' . $userId, []);

        if (isset($cart[$pet_id])) {
            $cart[$pet_id]['quantity'] += $request->quantity;
        } else {
            $cart[$pet_id] = [
                "name" => $product->description,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image_url
            ];
        }

        session()->put('cart_' . $userId, $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function buyNow(Request $request, $pet_id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Bạn cần đăng nhập để mua hàng.');
        }

        $userId = Auth::guard('customer')->id();
        $product = Pet::where('pet_id', $pet_id)->firstOrFail();

        $cart = session()->get('cart_' . $userId, []);

        if (isset($cart[$pet_id])) {
            $cart[$pet_id]['quantity'] += 1;
        } else {
            $cart[$pet_id] = [
                "name" => $product->description,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_url
            ];
        }

        session()->put('cart_' . $userId, $cart);

        return redirect()->route('User.cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng và sẵn sàng để thanh toán.');
    }



    public function removeFromCart(Request $request, $pet_id)
    {
        $userId = Auth::guard('customer')->id();
        $cart = $request->session()->get('cart_' . $userId, []);

        if (isset($cart[$pet_id])) {
            unset($cart[$pet_id]);
        }

        // Tính lại tổng số lượng và tổng giá trị
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Cập nhật lại session với key có userId
        $request->session()->put('cart_' . $userId, $cart);
        $request->session()->put('Cart_TotalQuantity_' . $userId, $totalQuantity);
        $request->session()->put('Cart_TotalPrice_' . $userId, $totalPrice);

        return redirect()->route('User.cart')->with('success', 'Xóa thú cưng khỏi giỏ hàng thành công!');
    }

    public function updateCart(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        $cart = session()->get('cart_' . $userId, []);
        $cartData = $request->cart;

        foreach ($cartData as $item) {
            $pet_id = $item['pet_id'];
            $newQuantity = max(1, (int) $item['quantity']); // đảm bảo số lượng >= 1

            if (isset($cart[$pet_id])) {
                $cart[$pet_id]['quantity'] = $newQuantity;
            }
        }

        session()->put('cart_' . $userId, $cart); // Lưu session mới theo userId

        // Tính tổng tiền mới
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Cập nhật tổng tiền cũng theo userId nếu cần
        session()->put('Cart_TotalPrice_' . $userId, $total);

        return response()->json([
            'success' => true,
            'newTotal' => number_format($total, 0, ',', '.')
        ]);
    }
}
