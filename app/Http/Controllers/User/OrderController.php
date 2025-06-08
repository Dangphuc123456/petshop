<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pet;
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

        // Lấy tất cả đơn hàng chưa hoàn thành
        $orders = Order::where('customer_name', $customer->name)
            ->whereIn('status', ['Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Đã thanh toán'])
            ->orderBy('order_date', 'desc')
            ->get();

        // Lấy sản phẩm cho từng đơn hàng
        foreach ($orders as $order) {
            $order->orderItems = OrderItem::where('order_id', $order->order_id)->get();
        }

        // Tách các nhóm đơn hàng theo trạng thái
        $pendingOrders = $orders->whereIn('status', ['Chờ Xác Nhân', 'Đã thanh toán']);
        $confirmedOrders = $orders->where('status', 'Đã xác nhận');
        $deliveringOrders = $orders->where('status', 'Đang giao hàng');

        // Lấy danh mục
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        return view('User.orders.pending', compact(
            'pendingOrders',
            'confirmedOrders',
            'deliveringOrders',
            'dogCategories',
            'catCategories',
            'accessoryCategories'
        ));
    }


    public function completedOrders()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Vui lòng đăng nhập để xem lịch sử đơn hàng.');
        }

        $customer = Auth::guard('customer')->user();

        $orders = Order::where('customer_name', $customer->name)
            ->whereIn('status', ['Hoàn thành', 'Đã hủy'])
            ->orderBy('order_date', 'desc')
            ->get();

        foreach ($orders as $order) {
            $order->orderItems = OrderItem::where('order_id', $order->order_id)->get();
        }

        // Tách các nhóm đơn hàng theo trạng thái
        $completedOrders = $orders->whereIn('status', ['Hoàn thành']);
        $cancelledOrders = $orders->where('status', 'Đã hủy');
        // Lấy danh sách danh mục sản phẩm
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        return view('User.orders.completed', compact(
            'completedOrders',
            'cancelledOrders',
            'dogCategories',
            'catCategories',
            'accessoryCategories'
        ));
    }

    public function cancel(Request $request, $order_id)
    {
        // Kiểm tra đăng nhập
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.login')->with('error', 'Vui lòng đăng nhập để hủy đơn hàng.');
        }

        $customer = Auth::guard('customer')->user();

        $order = Order::where('order_id', $order_id)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        if ($order->status === 'Chờ Xác Nhân') {

            $items = OrderItem::where('order_id', $order->order_id)->get();
            foreach ($items as $item) {
                $pet = Pet::find($item->pet_id);
                if ($pet) {
                    $pet->quantity_in_stock += $item->quantity;
                    $pet->save();
                }
            }
            $reason = $request->cancel_reason === 'Khác' ? $request->other_reason : $request->cancel_reason;
            $order->status = 'Đã hủy';
            $order->cancel_reason = $reason;
            $order->save();

            return redirect()->back()->with('success', 'Đơn hàng đã được hủy với lý do:' . $reason);
        }

        return redirect()->back()->with('error', 'Không thể hủy đơn hàng này vì trạng thái không phù hợp.');
    }
}
