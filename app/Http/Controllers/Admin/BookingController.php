<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        // Lấy dữ liệu phân trang, sắp xếp theo ngày nhận phòng mới nhất trước
        $bookings = Booking::orderBy('CheckInDate', 'desc')
            ->paginate($perPage)
            ->appends(['perPage' => $perPage]);

        return view('admin.booking.index', compact('bookings', 'perPage'));
    }
    public function create()
    {
        $roomsNorth = Room::where('Status', 'Available')->where('Region', 'Bắc')->get();
        $roomsSouth = Room::where('Status', 'Available')->where('Region', 'Nam')->get();

        $occupiedNorth = Room::where('Status', 'Occupied')->where('Region', 'Bắc')->get();
        $occupiedSouth = Room::where('Status', 'Occupied')->where('Region', 'Nam')->get();
        return view('Admin.booking.create', compact('occupiedNorth', 'occupiedSouth', 'roomsNorth', 'roomsSouth'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'RoomID' => 'required|exists:Room,RoomID',
            'CustomerName' => 'required|string|max:255',
            'PhoneNumber' => 'required|string|max:15',
            'Email' => 'nullable|email',
            'CheckInDate' => 'required|date',
            'CheckOutDate' => 'required|date|after_or_equal:CheckInDate',
            'LocationName' => 'required|string|max:255',
        ]);

        // Lấy phòng để tính giá
        $room = Room::where('RoomID', $validated['RoomID'])->first();

        $checkIn = new \DateTime($validated['CheckInDate']);
        $checkOut = new \DateTime($validated['CheckOutDate']);
        $diffDays = $checkOut->diff($checkIn)->days;
        if ($diffDays == 0) $diffDays = 1; // Ít nhất 1 ngày

        $totalPrice = $room->PricePerNight * $diffDays;

        // Tạo booking mới
        Booking::create([
            'RoomID' => $validated['RoomID'],
            'CustomerName' => $validated['CustomerName'],
            'PhoneNumber' => $validated['PhoneNumber'],
            'Email' => $validated['Email'],
            'CheckInDate' => $validated['CheckInDate'],
            'CheckOutDate' => $validated['CheckOutDate'],
            'LocationName' => $validated['LocationName'],
            'TotalPrice' => $totalPrice,
            'BookingStatus' => 'Đã xác nhận',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ✅ Cập nhật trạng thái phòng thành Occupied
        $room->Status = 'Occupied';
        $room->save();

        return redirect()->route('admin.booking.index')->with('success', 'Đặt phòng thành công!');
    }

    public function confirm($BookingID)
    {
        $booking = Booking::find($BookingID);

        if (!$booking) {
            return redirect()->route('admin.booking.index')->with('error', 'Không tìm thấy phòng đặt.');
        }

        // Kiểm tra nếu trạng thái không phải là "Chờ xác nhận" thì không cho xác nhận
        if ($booking->BookingStatus !== 'Chờ xác nhận') {
            return redirect()->route('admin.booking.index')->with('warning', 'Chỉ có thể xác nhận các đặt phòng đang chờ xác nhận.');
        }

        $booking->BookingStatus = 'Đã xác nhận';
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Đã xác nhận đặt phòng thành công.');
    }

    public function checkout($BookingID)
    {
        $booking = Booking::findOrFail($BookingID);

        if ($booking->BookingStatus !== 'Đã xác nhận') {
            return redirect()->route('admin.booking.index')->with('warning', 'Chỉ có thể hoàn thành dịch vụ khi đặt phòng đã được xác nhận.');
        }

        $booking->BookingStatus = 'Đã trả phòng';
        $booking->save();

        if ($booking->RoomID) {
            $room = Room::find($booking->RoomID);
            if ($room) {
                $room->Status = 'Available';
                $room->save();
            }
        }

        return redirect()->route('admin.booking.index')->with('success', 'Đã hoàn thành dịch vụ.');
    }

    public function cancel($BookingID)
    {
        $booking = Booking::findOrFail($BookingID);

        if ($booking->BookingStatus !== 'Chờ xác nhận') {
            return redirect()->route('admin.booking.index')->with('warning', 'Chỉ có thể hủy khi đặt phòng đang chờ xác nhận.');
        }

        $booking->BookingStatus = 'Đã hủy';
        $booking->save();

        if ($booking->RoomID) {
            $room = Room::find($booking->RoomID);
            if ($room) {
                $room->Status = 'Available';
                $room->save();
            }
        }

        return redirect()->route('admin.booking.index')->with('success', 'Đặt phòng đã bị hủy và phòng đã được mở lại.');
    }

    public function show($BookingID)
    {
        $booking = Booking::findOrFail($BookingID);

        return view('admin.booking.detail', compact('booking'));
    }
}
