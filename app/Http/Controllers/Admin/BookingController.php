<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $booking = Booking::all();
        return view('admin.booking.index',compact('booking'));
    }
    public function confirm($BookingID)
    {
        $booking = Booking::find($BookingID);

        if ($booking) {
            $booking->status = 'Đã xác nhận';
            $booking->save();

            return redirect()->route('admin.booking.index')->with('success', 'Đã xác nhận đặt phòng thành công.');
        } else {
            return redirect()->route('admin.booking.index')->with('error', 'Không tìm thấy phòng đặt.');
        }
    }
    public function checkout($BookingID)
    {
        // Find the booking using the provided BookingID  
        $booking = Booking::findOrFail($BookingID);

        $booking->update([
            'BookingStatus' => 'Đã trả phòng',  
        ]);

        if ($booking->RoomID) {
            $room = Room::find($booking->RoomID);
            if ($room) {
                $room->update([
                    'Status' => 'Available', 
                ]);
            }
        }
        return redirect()->route('admin.appointments.index')->with('success', 'Đã hoàn thành dịch vụ.');
    }
}
