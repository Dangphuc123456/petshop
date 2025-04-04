<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointment = Appointment::all();
        return view('admin.appointments.index',compact('appointment'));
    }
    public function confirm($AppointmentID)
    {
        $appointment = Appointment::find($AppointmentID);

        if ($appointment) {
            $appointment->status = 'Đã xác nhận';
            $appointment->save();

            return redirect()->route('admin.appointments.index')->with('success', 'Xác nhận đơn lịch hẹn thành công.');
        } else {
            return redirect()->route('admin.appointments.index')->with('error', 'Không tìm thấy lịch hẹn.');
        }
    }
    public function complete($AppointmentID)
    {
        $appointment = Appointment::findOrFail($AppointmentID);

        // Update the order status
        $appointment->update([
            'Status' => 'Hoàn thành', // Assuming 'Status' is the field indicating the order status
        ]);
        return redirect()->route('admin.appointments.index')->with('success', 'Đã hoàn thành dịch vụ.');
    }
    public function cancel($AppointmentID)
    {
        $appointment = Appointment::findOrFail($AppointmentID);
        $appointment->status = 'Hủy';
        $appointment->save();

        return redirect()->route('admin.appointments.index')->with('success', 'Đã hủy lịch hẹn.');
    }
}
