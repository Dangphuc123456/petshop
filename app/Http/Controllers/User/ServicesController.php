<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function showappointment()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $service = Service::all();
        return view('User.appointment', compact('service', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ServiceID' => 'required|exists:services,ServiceID',
            'CustomerName' => 'required|string|max:100',
            'CustomerContact' => 'required|string|max:100',
            'AppointmentDate' => 'required|date',
            'LocationName' => 'required|string|max:255', // Lấy trực tiếp từ form
        ]);

        try {
            $service = Service::find($validatedData['ServiceID']);

            // Kiểm tra nếu dịch vụ không tồn tại
            if (!$service) {
                return redirect()->back()->with('error', 'Dịch vụ không tồn tại!');
            }

            // Tạo lịch hẹn
            $appointment = Appointment::create([
                'ServiceID' => $validatedData['ServiceID'],
                'ServiceName' => $service->ServiceName,
                'CustomerName' => $validatedData['CustomerName'],
                'CustomerContact' => $validatedData['CustomerContact'],
                'AppointmentDate' => $validatedData['AppointmentDate'],
                'LocationName' => $validatedData['LocationName'],
                'Status' => 'Chờ xác nhận',
            ]);

            // Kiểm tra nếu tạo thất bại
            if (!$appointment) {
                return redirect()->back()->with('error', 'Đặt lịch không thành công, vui lòng thử lại!');
            }

            return redirect()->back()->with('success', 'Lịch hẹn của bạn đã được đặt thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }
    public function booking()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $rooms = Room::where('Status', 'Available')->get();
        $bookings = Booking::join('Room', 'Booking.RoomID', '=', 'Room.RoomID')
            ->select('Booking.*', 'Room.PricePerNight', 'Room.Status as RoomStatus')
            ->get();

        return view('User.booking', compact('bookings', 'rooms', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
    public function bookingstore(Request $request)
    {
        $request->validate([
            'RoomID' => 'required|exists:room,RoomID',
            'CustomerName' => 'required|string|max:100',
            'PhoneNumber' => 'required|string|max:15',
            'Email' => 'nullable|email|max:100',
            'CheckInDate' => 'required|date',
            'CheckOutDate' => 'required|date|after:CheckInDate',
        ]);

        // Lấy thông tin phòng
        $room = Room::find($request->RoomID);
        if (!$room) {
            return redirect()->back()->withErrors(['RoomID' => 'Room không tồn tại.']);
        }

        // Kiểm tra nếu phòng đã có người đặt
        if ($room->Status == 'Occupied') {
            return redirect()->back()->withErrors(['RoomID' => 'Phòng này đã được đặt. Vui lòng chọn phòng khác.']);
        }

        // Tính số đêm giữa ngày nhận phòng và ngày trả phòng
        $checkInDate = Carbon::parse($request->CheckInDate);
        $checkOutDate = Carbon::parse($request->CheckOutDate);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);

        // Kiểm tra số đêm hợp lệ
        if ($numberOfNights <= 0) {
            return redirect()->back()->withErrors(['CheckOutDate' => 'Ngày trả phòng phải sau ngày nhận phòng.']);
        }

        // Tính tổng tiền
        $pricePerNight = $room->PricePerNight ?? 200000; // Lấy giá từ database hoặc mặc định 200k
        $totalPrice = $pricePerNight * $numberOfNights;

        // Tạo đơn đặt phòng
        $booking = new Booking();
        $booking->RoomID = $request->RoomID;
        $booking->CustomerName = $request->CustomerName;
        $booking->PhoneNumber = $request->PhoneNumber;
        $booking->Email = $request->Email;
        $booking->CheckInDate = $request->CheckInDate;
        $booking->CheckOutDate = $request->CheckOutDate;
        $booking->TotalPrice = $totalPrice;
        $booking->BookingStatus = 'Chờ xác nhận'; // Mặc định
        $booking->save();

        // Cập nhật trạng thái phòng thành 'Occupied'
        $room->Status = 'Occupied';
        $room->save();

        return redirect()->route('User.booking')->with('message', 'Đặt phòng thành công! Chờ xác nhận.');
    }

    public function appointment()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa  
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.userslogin')->with('error', 'Vui lòng đăng nhập để xem lịch hẹn.');
        }

        // Lấy thông tin khách hàng hiện tại  
        $customer = Auth::guard('customer')->user();

        // Lấy danh sách lịch hẹn với trạng thái Pending  
        $booking = Booking::where('CustomerName', $customer->name)
            ->where('BookingStatus', 'Chờ xác nhận') // Thêm điều kiện cho trạng thái  
            ->get();

        $appointments = Appointment::where('CustomerName', $customer->name)
            ->whereIn('Status', ['Chờ xác nhận', 'Đã xác nhận']) // Dùng whereIn() để lọc nhiều trạng thái
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
            ->whereIn('Status', ['Hoàn thành', 'Hủy'])
            ->orderBy('AppointmentDate', 'desc')
            ->get();

        // Lấy danh sách phòng đã hoàn thành và trả phòng
        $completedBookings = Booking::where('CustomerName', $customer->name)
            ->whereIn('BookingStatus', ['Confirmed', 'Cancelled'])
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
