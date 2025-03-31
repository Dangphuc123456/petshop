<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin()
    {
        return view('User.login');
    }
    public function login(Request $request)
    {
        // Xác nhận đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Lấy thông tin đăng nhập
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Kiểm tra xem checkbox có được chọn không

        // Thử đăng nhập với thông tin xác thực và "Remember Me"
        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            return redirect()->route('User.home')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu đăng nhập không thành công, trả về lỗi
        return back()->withErrors(['login_error' => 'Email hoặc mật khẩu không chính xác.']);
    }


    // Đăng xuất
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('User.home')->with('success', 'Đăng xuất thành công!');
    }
}
