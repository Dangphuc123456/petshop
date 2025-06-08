<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        // Lấy dữ liệu phân trang, sắp xếp theo ngày hẹn mới nhất trước
        $appointments = Appointment::orderBy('AppointmentDate', 'desc')
            ->paginate($perPage)
            ->appends(['perPage' => $perPage]);
        $service = Service::all();
        return view('admin.appointments.index', compact('appointments', 'perPage', 'service'));
    }
    public function create()
    {
        $service = Service::all();
        return view('admin.appointments.create', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ServiceID' => 'required|exists:services,ServiceID',
            'LocationName' => 'required|string|max:255',
            'CustomerName' => 'required|string|max:255',
            'CustomerContact' => 'required|string|max:255',
            'AppointmentDate' => 'required|date',
        ]);


        // Lấy tên dịch vụ từ bảng services
        $service = \App\Models\Service::find($request->ServiceID);

        // Tạo mới lịch hẹn
        Appointment::create([
            'ServiceID' => $request->ServiceID,
            'ServiceName' => $service->ServiceName ?? null, // Thêm ServiceName nếu tồn tại
            'LocationName' => $request->LocationName,
            'CustomerName' => $request->CustomerName,
            'CustomerContact' => $request->CustomerContact,
            'AppointmentDate' => $request->AppointmentDate,
            'Status' => 'Đã xác nhận',
        ]);

        return redirect()->route('admin.appointments.index')->with('success', 'Đặt lịch thành công');
    }
    public function confirm($AppointmentID, Request $request)
    {
        $appointment = Appointment::find($AppointmentID);

        if ($appointment && $appointment->Status == 'Chờ xác nhận') {
            $appointment->Status = 'Đã xác nhận';
            $appointment->save();

            return redirect()->route('admin.appointments.index', [
                'page' => $request->input('page'),
                'perPage' => $request->input('perPage')
            ])->with('success', 'Xác nhận đơn lịch hẹn thành công.');
        }

        return redirect()->route('admin.appointments.index', [
            'page' => $request->input('page'),
            'perPage' => $request->input('perPage')
        ])->with('error', 'Lịch hẹn không hợp lệ hoặc đã được xử lý.');
    }

    public function complete($AppointmentID, Request $request)
    {
        $appointment = Appointment::findOrFail($AppointmentID);

        if ($appointment->Status === 'Đã xác nhận') {
            $appointment->Status = 'Hoàn thành';
            $appointment->save();

            return redirect()->route('admin.appointments.index', [
                'page' => $request->input('page'),
                'perPage' => $request->input('perPage')
            ])->with('success', 'Đã hoàn thành dịch vụ.');
        }

        return redirect()->route('admin.appointments.index', [
            'page' => $request->input('page'),
            'perPage' => $request->input('perPage')
        ])->with('error', 'Chỉ có lịch hẹn đã xác nhận mới được hoàn thành.');
    }

    public function cancel($AppointmentID, Request $request)
    {
        $appointment = Appointment::findOrFail($AppointmentID);

        if (!in_array($appointment->Status, ['Đã hủy', 'Hoàn thành'])) {
            $appointment->Status = 'Đã hủy';
            $appointment->save();

            return redirect()->route('admin.appointments.index', [
                'page' => $request->input('page'),
                'perPage' => $request->input('perPage')
            ])->with('success', 'Đã hủy lịch hẹn.');
        }

        return redirect()->route('admin.appointments.index', [
            'page' => $request->input('page'),
            'perPage' => $request->input('perPage')
        ])->with('error', 'Lịch hẹn đã được hoàn thành hoặc hủy trước đó.');
    }

    public function show($AppointmentID)
    {
        $appointment = Appointment::findOrFail($AppointmentID);
        $serviceName = Service::where('ServiceID', $appointment->ServiceID)->value('ServiceName');
        return view('admin.appointments.detail', compact('appointment', 'serviceName'));
    }
}
