<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Tính tổng tiền giỏ hàng
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('User.cart', compact('cart', 'total', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }

    public function addToCart(Request $request, $pet_id)
    {
        $product = Pet::where('pet_id', $pet_id)->firstOrFail();

        $cart = session()->get('cart', []);

        // Nếu sản phẩm đã có trong giỏ, tăng số lượng
        if (isset($cart[$pet_id])) {
            $cart[$pet_id]['quantity'] += $request->quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ
            $cart[$pet_id] = [
                "name" => $product->description,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image_url
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }
    public function removeFromCart(Request $request, $pet_id)
    {
        // Đảm bảo sử dụng đúng session key
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$pet_id])) {
            unset($cart[$pet_id]);
        }

        // Tính toán lại tổng giá trị giỏ hàng
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Cập nhật lại session với key 'cart'
        $request->session()->put('cart', $cart);
        $request->session()->put('Cart_TotalQuantity', $totalQuantity);
        $request->session()->put('Cart_TotalPrice', $totalPrice);

        return redirect()->route('User.cart')->with('success', 'Xóa thú cưng khỏi giỏ hàng thành công!');
    }
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $cartData = $request->cart;

        foreach ($cartData as $item) {
            $pet_id = $item['pet_id'];
            $newQuantity = max(1, (int) $item['quantity']); // Đảm bảo số lượng >= 1

            if (isset($cart[$pet_id])) {
                $cart[$pet_id]['quantity'] = $newQuantity;
            }
        }

        session()->put('cart', $cart); // Lưu session mới

        // Tính tổng tiền mới
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return response()->json([
            'success' => true,
            'newTotal' => number_format($total, 0, ',', '.')
        ]);
    }
}
