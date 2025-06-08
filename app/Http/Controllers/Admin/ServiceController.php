<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); 
        $services = Service::orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends(['perPage' => $perPage]);

        return view('admin.servicee.index', compact('services', 'perPage'));
    }

    public function create()
    {
        return view('admin.servicee.create');
    }

    // Lưu dịch vụ mới vào database
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'ServiceName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'ServiceDuration' => 'nullable|integer|min:0',
            'AvailableSlots' => 'nullable|integer|min:0',
        ]);
        Service::create([
            'ServiceName' => $request->ServiceName,
            'Description' => $request->Description,
            'Price' => $request->Price,
            'ServiceDuration' => $request->ServiceDuration,
            'AvailableSlots' => $request->AvailableSlots,
        ]);

        return redirect()->route('admin.servicee.index')->with('success', 'Tạo dịch vụ thành công!');
    }
    public function show($service_id)
    {
        $service = Service::findOrFail($service_id);
        return view('admin.servicee.detail', compact('service'));
    }
    // Hiển thị form chỉnh sửa dịch vụ
    public function edit($service_id)
    {
        $service = Service::findOrFail($service_id);
        return view('admin.servicee.edit', compact('service'));
    }

    // Cập nhật dịch vụ
    public function update(Request $request, $service_id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'ServiceName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'ServiceDuration' => 'nullable|integer|min:0',
            'CreatedAt' => 'nullable|date',
            'AvailableSlots' => 'nullable|integer|min:0',
        ]);

        $service = Service::findOrFail($service_id);

        // Cập nhật dữ liệu
        $service->update([
            'ServiceName' => $request->ServiceName,
            'Description' => $request->Description,
            'Price' => $request->Price,
            'ServiceDuration' => $request->ServiceDuration,
            'CreatedAt' => $request->CreatedAt ?? $service->CreatedAt,
            'AvailableSlots' => $request->AvailableSlots,
        ]);

        return redirect()->route('admin.servicee.index')->with('success', 'Cập nhật dịch vụ thành công!');
    }
    public function destroy($service_id)
    {
        $service = Service::findOrFail($service_id);
        $service->delete();

        return redirect()->route('admin.servicee.index')
            ->with('success', 'Xóa dịch vụ thành công!');
    }
}
