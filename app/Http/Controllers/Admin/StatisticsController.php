<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingDetailsExport;
use App\Exports\OrderDetailsExport;
use App\Exports\AppointmentDetailsExport;
use App\Exports\PurchaseOrderDetailsExport;

class StatisticsController extends Controller
{
    public function revenueStats()
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        // Doanh thu tuần
        $bookingWeek = DB::table('booking')->where('BookingStatus', 'Đã trả phòng')
            ->whereDate('created_at', '>=', $startOfWeek)->sum('TotalPrice');
        $orderWeek = DB::table('orders')->where('status', 'Hoàn thành')->whereDate('created_at', '>=', $startOfWeek)
            ->sum('total_amount');
        $appointmentWeek = DB::table('appointments as a')
            ->join('services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->where('a.Status', 'Hoàn thành')
            ->whereDate('a.created_at', '>=', $startOfWeek)->sum('s.Price');
        $totalWeek = $bookingWeek + $orderWeek + $appointmentWeek;
        $bookingCountWeek = DB::table('booking')->where('BookingStatus', 'Đã trả phòng')
            ->whereDate('created_at', '>=', $startOfWeek)->count();
        $productSoldWeek = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->where('orders.status', 'Hoàn thành')
            ->whereDate('orders.created_at', '>=', $startOfWeek)
            ->sum('order_items.quantity');

        $appointmentCountWeek = DB::table('appointments')
            ->where('Status',  'Hoàn thành')
            ->whereDate('created_at', '>=', $startOfWeek)
            ->count();



        // Doanh thu tháng
        $bookingMonth = DB::table('booking')->where('BookingStatus', 'Đã trả phòng')
            ->whereDate('created_at', '>=', $startOfMonth)->sum('TotalPrice');
        $orderMonth = DB::table('orders')->where('status', 'Hoàn thành')
            ->whereDate('created_at', '>=', $startOfMonth)->sum('total_amount');
        $appointmentMonth = DB::table('appointments as a')
            ->join('services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->where('a.Status',  'Hoàn thành')
            ->whereDate('a.created_at', '>=', $startOfMonth)->sum('s.Price');
        $totalMonth = $bookingMonth + $orderMonth + $appointmentMonth;
        $bookingCountMonth = DB::table('booking')
            ->where('BookingStatus', 'Đã trả phòng')
            ->whereDate('created_at', '>=', $startOfMonth)
            ->count();

        $productSoldMonth = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->where('orders.status', 'Hoàn thành')
            ->whereDate('orders.created_at', '>=', $startOfMonth)
            ->sum('order_items.quantity');

        $appointmentCountMonth = DB::table('appointments')
            ->where('Status',  'Hoàn thành')
            ->whereDate('created_at', '>=', $startOfMonth)
            ->count();


        //    {---Doanh thu năm---}
        $bookingYear = DB::table('booking')->where('BookingStatus', 'Đã trả phòng')
            ->whereDate('created_at', '>=', $startOfYear)->sum('TotalPrice');
        $orderYear = DB::table('orders')->where('status', 'Hoàn thành')
            ->whereDate('created_at', '>=', $startOfYear)->sum('total_amount');
        $appointmentYear = DB::table('appointments as a')
            ->join('services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->whereIn('a.Status', ['Đã xác nhận', 'Hoàn thành'])
            ->whereDate('a.created_at', '>=', $startOfYear)->sum('s.Price');
        $totalYear = $bookingYear + $orderYear + $appointmentYear;
        $bookingCountYear = DB::table('booking')
            ->where('BookingStatus', 'Đã trả phòng')
            ->whereDate('created_at', '>=', $startOfYear)
            ->count();

        $productSoldYear = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->where('orders.status', 'Hoàn thành')
            ->whereDate('orders.created_at', '>=', $startOfYear)
            ->sum('order_items.quantity');

        $appointmentCountYear = DB::table('appointments')
            ->where('Status',  'Hoàn thành')
            ->whereDate('created_at', '>=', $startOfYear)
            ->count();


        $purchaseMonth = DB::table('purchase_orders')
            ->whereYear('order_date', Carbon::now()->year)
            ->whereMonth('order_date', Carbon::now()->month)
            ->sum('total_amount');

        // Tổng chi phí nhập hàng năm
        $purchaseYear = DB::table('purchase_orders')
            ->whereYear('order_date', Carbon::now()->year)
            ->sum('total_amount');

        return view('admin.revenue.statistics', compact(
            'bookingWeek',
            'orderWeek',
            'appointmentWeek',
            'totalWeek',
            'bookingMonth',
            'orderMonth',
            'appointmentMonth',
            'totalMonth',
            'bookingYear',
            'orderYear',
            'appointmentYear',
            'totalYear',
            'purchaseMonth',
            'purchaseYear',
            'bookingCountWeek',
            'productSoldWeek',
            'appointmentCountWeek',
            'bookingCountMonth',
            'productSoldMonth',
            'appointmentCountMonth',
            'bookingCountYear',
            'productSoldYear',
            'appointmentCountYear'
        ));
    }
    public function exportBookingDetails(Request $request)
    {
        return Excel::download(new BookingDetailsExport(
            $request->query('periodType'),
            $request->query('periodValue')
        ), 'booking_details.xlsx');
    }

    public function exportOrderDetails(Request $request)
    {
        return Excel::download(
            new OrderDetailsExport(
                $request->query('periodType'),
                $request->query('periodValue')
            ),
            'order_details.xlsx'
        );
    }


    public function exportAppointmentDetails(Request $request)
    {
        return Excel::download(new AppointmentDetailsExport(
            $request->query('periodType'),
            $request->query('periodValue')
        ), 'appointment_details.xlsx');
    }

     public function exportPurchaseOrderDetails(Request $request)
    {
        return Excel::download(
            new PurchaseOrderDetailsExport(
                $request->query('periodType'),
                $request->query('periodValue')
            ),
            'purchase_order_details.xlsx'
        );
    }
}
