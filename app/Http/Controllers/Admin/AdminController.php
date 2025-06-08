<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Pet;
use App\Models\PurchaseOrder;
use App\Models\Room;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.index');
    }
    public function showdashboard()
    {
        return view('dashboard');
    }
    public function fetchNewOrders()
    {
        $newOrders = Order::whereIn('status', ['Chờ xác nhận', 'Đã thanh toán'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json($newOrders);
    }
    public function fetchNewCalendar()
    {
        $appointments = Appointment::where('Status', 'Chờ xác nhận')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $bookings = Booking::where('BookingStatus', 'Chờ xác nhận')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'appointments' => $appointments,
            'bookings' => $bookings,
        ]);
    }

    public function search(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->withErrors('Bạn cần đăng nhập để truy cập.');
        }

        $query = trim($request->input('query'));
        $queryFormatted = $query;

        try {
            $queryFormatted = Carbon::createFromFormat('d/m/Y', $query)->format('Y-m-d');
        } catch (\Exception $e) {
            // Nếu không phải ngày thì giữ nguyên $queryFormatted
        }

        // Xử lý query để lấy số (bỏ dấu '.' và ',')
        $numeric = str_replace([',', '.'], '', $query);
        $isNumeric = is_numeric($numeric);
        $price = $isNumeric ? (float) $numeric : null;

        // Tìm pets như cũ
        $pets = Pet::where('description', 'LIKE', "%{$query}%")
            ->orWhere('species', 'LIKE', "%{$query}%")
            ->orWhere('breed', 'LIKE', "%{$query}%")
            ->get();

        // Tìm orders với nhóm điều kiện để xử lý giá tiền chính xác
        $orders = Order::where(function ($q) use ($query, $queryFormatted, $isNumeric, $price) {
            $q->where('order_id', 'LIKE', "%{$query}%")
                ->orWhere('order_date', 'LIKE', "%{$queryFormatted}%")
                ->orWhere('customer_name', 'LIKE', "%{$query}%")
                ->orWhere('status', 'LIKE', "%{$query}%");

            if ($isNumeric) {
                // Tìm theo khoảng giá ±100000
                $q->orWhereBetween('total_amount', [max($price - 100000, 0), $price + 100000]);
            } else {
                $q->orWhere('total_amount', 'LIKE', "%{$query}%");
            }
        })->get();

        // Tương tự cho purchaseOrders
        $purchaseOrders = PurchaseOrder::where(function ($q) use ($query, $queryFormatted, $isNumeric, $price) {
            $q->where('purchase_order_id', 'LIKE', "%{$query}%")
                ->orWhere('order_date', 'LIKE', "%{$queryFormatted}%");

            if ($isNumeric) {
                $q->orWhereBetween('total_amount', [max($price - 100000, 0), $price + 100000]);
            } else {
                $q->orWhere('total_amount', 'LIKE', "%{$query}%");
            }
        })->get();

        $room = Room::where('status', 'LIKE', "%{$query}%")->get();

        $supplier = Supplier::where('name', 'LIKE', "%{$query}%")
            ->orWhere('contact_person', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->get();

        return view('admin.search.index', compact('pets', 'orders', 'purchaseOrders', 'query', 'room', 'supplier'));
    }
}
