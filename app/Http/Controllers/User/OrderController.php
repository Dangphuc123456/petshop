<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pendingOrders()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng.');
        }

        $customer = Auth::guard('customer')->user();

        // Lấy danh sách đơn hàng chưa hoàn thành kèm theo các sản phẩm trong đơn
        $orders = Order::where('customer_id', $customer->id)
            ->whereIn('status', ['pending', 'Đã xác nhận', 'Đang giao hàng']) // Trạng thái: hoàn thành, hủy
            ->orderBy('order_date', 'desc')
            ->get();

        foreach ($orders as $order) {
            $order->items = OrderItem::where('order_id', $order->order_id)->get();
        }
        // Lấy danh sách danh mục sản phẩm
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        return view('User.orders.pending', compact('orders', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }

    public function completedOrders()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Vui lòng đăng nhập để xem lịch sử đơn hàng.');
        }

        $customer = Auth::guard('customer')->user();

        // Lấy danh sách đơn hàng đã hoàn thành hoặc bị hủy
        $orders = Order::where('customer_id', $customer->id)
            ->whereIn('status', ['Hoàn thành', 'Đã hủy']) // Trạng thái: hoàn thành, hủy
            ->orderBy('order_date', 'desc')
            ->get();

        foreach ($orders as $order) {
            $order->items = OrderItem::where('order_id', $order->order_id)->get();
        }
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        return view('User.orders.completed', compact('orders', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
}
