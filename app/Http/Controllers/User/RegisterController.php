<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showregister()
   {
     return view('User.register');
   }
   public function register(Request $request)
   {
       // Validate dữ liệu
       $validator = Validator::make($request->all(), [
           'username' => 'required|unique:customers,username|max:50',
           'password' => 'required|min:6|confirmed',
           'email' => 'required|email|unique:customers,email|max:100',
           'name' => 'required|max:100',
           'phone' => 'required|regex:/^\d{10,15}$/',
           'address' => 'required|max:255',
       ]);

       if ($validator->fails()) {
           return redirect()->route('User.usersregister')
               ->withErrors($validator)
               ->withInput();
       }

       // Tạo tài khoản mới
       $customer = new Customer();
       $customer->username = $request->username;
       $customer->password = Hash::make($request->password); // Mã hóa mật khẩu
       $customer->email = $request->email;
       $customer->name = $request->name;
       $customer->phone = $request->phone;
       $customer->address = $request->address;
       $customer->save();

       return redirect()->route('User.userslogin')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
   }
}
