<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function appointment()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa  
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.userslogin')->with('error', 'Vui lòng đăng nhập để xem lịch hẹn.');
        }

        // Lấy thông tin khách hàng hiện tại  
        $customer = Auth::guard('customer')->user();

        // Lấy danh sách lịch hẹn với trạng thái Pending  
        $booking = Booking::where('customer_name', $customer->name)
            ->where('BookingStatus', 'Pending') // Thêm điều kiện cho trạng thái  
            ->get();

        $appointments = Appointment::where('CustomerName', $customer->name)
            ->where('Status', 'Pending') // Thêm điều kiện cho Appointment  
            ->orderBy('AppointmentDate', 'desc')
            ->get();
        // Lấy danh mục sản phẩm  
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        return view('User.orders.appointment', compact('appointments', 'booking', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }

    public function servicehistory()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.userslogin')->with('error', 'Vui lòng đăng nhập để xem lịch sử dịch vụ.');
        }

        // Lấy thông tin khách hàng hiện tại
        $customer = Auth::guard('customer')->user();

        // Lấy danh sách lịch hẹn đã hoàn thành
        $appointment = Appointment::where('CustomerName', $customer->name)
            ->where('Status',) // Trạng thái "Hoàn thành"
            ->orderBy('AppointmentDate', 'desc')
            ->get();

        // Lấy danh sách phòng đã hoàn thành và trả phòng
        $completedBookings = Booking::where('customer_name', $customer->name)
            ->where('BookingStatus', 'Confirmed','Cancelled')
            ->get();

        // Lấy danh mục sản phẩm
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        return view('User.orders.servicehistory', compact('appointment', 'completedBookings', 'dogCategories',   'catCategories',   'accessoryCategories'));
    }
}
