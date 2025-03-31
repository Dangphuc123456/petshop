<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Vui lòng đăng nhập để xem thông tin.');
        }

        $customer = Auth::guard('customer')->user();
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        return view('User.orders.profile', compact('customer', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }

    // Cập nhật thông tin khách hàng
    public function updateProfile(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Vui lòng đăng nhập để cập nhật thông tin.');
        }

        $customer = Customer::find(Auth::guard('customer')->id()); // Lấy đúng model

        $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100|unique:customers,email,' . $customer->customer_id . ',customer_id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Cập nhật thông tin khách hàng
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->password ? Hash::make($request->password) : $customer->password
        ]);

        return redirect()->route('User.orders.profile')->with('success', 'Cập nhật thông tin thành công.');
    }
}
