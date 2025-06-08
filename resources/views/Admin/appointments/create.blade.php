@extends('Admin.admin')

@section('title', 'Đặt lịch hẹn')

@section('main')

<div class="container mt-5 p-4 rounded shadow-sm" style="background-color: #f8f9fa;"> {{-- Tiêu đề với nền vàng --}}
    <div class="rounded-top text-center p-3" style="background-color: #ffc107;">
        <h4 class="fw-bold text-dark m-0"><i class="bi bi-calendar-check-fill"></i> Thông Tin Đặt Lịch</h4>
    </div>
    <form action="{{ route('admin.appointments.store') }}" method="POST" class="p-4">
        @csrf
        <div class="mb-3">
            <label for="ServiceID" class="form-label fw-bold">Chọn dịch vụ <span class="text-danger">*</span></label>
            <select id="ServiceID" name="ServiceID" class="form-select" required>
                <option value="">-- Chọn dịch vụ --</option>
                @foreach($service as $item)
                <option value="{{ $item->ServiceID }}">{{ $item->ServiceName }} - {{ number_format($item->Price, 0, ',', '.') }}đ</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="LocationName" class="form-label fw-bold">Chọn địa điểm <span class="text-danger">*</span></label>
            <select id="LocationName" name="LocationName" class="form-select" required>
                <option value="">-- Chọn địa điểm --</option>
                <option value="Số 168 Thượng Đình - Thanh Xuân - Hà Nội">Số 168 Thượng Đình - Thanh Xuân - Hà Nội</option>
                <option value="294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh">294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="CustomerName" class="form-label fw-bold">Tên khách hàng <span class="text-danger">*</span></label>
            <input type="text" id="CustomerName" name="CustomerName" class="form-control" placeholder="Nhập tên khách hàng" required>
        </div>

        <div class="mb-3">
            <label for="CustomerContact" class="form-label fw-bold">Thông tin liên lạc <span class="text-danger">*</span></label>
            <input type="text" id="CustomerContact" name="CustomerContact" class="form-control" placeholder="SĐT hoặc Email" required>
        </div>

        <div class="mb-3">
            <label for="AppointmentDate" class="form-label fw-bold">Ngày / Giờ hẹn <span class="text-danger">*</span></label>
            <input type="datetime-local" id="AppointmentDate" name="AppointmentDate" class="form-control" required>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-5">
                <i class="bi bi-check-circle-fill"></i> Đặt lịch
            </button>
        </div>
    </form>
</div>
@endsection