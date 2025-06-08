@extends('Admin.admin')
@section('title', 'Chi Tiết Lịch Hẹn')
@section('main')

<div class="container py-4">
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-header bg-primary text-white rounded-top-4 text-center">
            <h3 class="fw-bold mb-0" style="font-size: 20px;">
                📋 Chi Tiết Lịch Hẹn
            </h3>
        </div>

        <div class="card border-0 shadow-sm p-4 bg-light rounded">
            <h5 class="mb-4 fw-bold text-primary">Thông tin lịch hẹn</h5>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Mã lịch hẹn:</label>
                <div class="col-sm-9">
                    <span class="text-muted">#{{ $appointment->AppointmentID }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Tên dịch vụ:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $appointment->ServiceName }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Khách hàng:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $appointment->CustomerName }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Số điện thoại:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $appointment->CustomerContact }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Ngày hẹn:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ \Carbon\Carbon::parse($appointment->AppointmentDate)->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Địa điểm:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $appointment->LocationName }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Trạng thái:</label>
                <div class="col-sm-9">
                    @php
                    $status = $appointment->Status;
                    $badgeClass = match ($status) {
                    'Đã hủy' => 'badge bg-danger',
                    'Hoàn thành' => 'badge bg-success',
                    default => 'badge bg-primary',
                    };
                    @endphp
                    <span class="{{ $badgeClass }} px-3 py-2 rounded-pill">{{ $status }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Lý do hủy:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $appointment->CancellationReason }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Ngày hẹn:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ \Carbon\Carbon::parse($appointment->created_at)->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Cập nhật lần cuối:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ \Carbon\Carbon::parse($appointment->updated_at)->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-center rounded-bottom-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                {{-- Nút quay lại --}}
                <a href="{{ route('admin.appointments.index') }}"
                    class="btn btn-outline-primary fw-semibold px-4 {{ Auth::guard('admin')->check() ? '' : 'disabled' }}"
                    style="font-size: 16px;"
                    @if(!Auth::guard('admin')->check())
                    style="pointer-events: none;" title="Bạn cần đăng nhập Admin để truy cập"
                    @endif>
                    ← Quay lại danh sách
                </a>
                {{-- Nút xác nhận --}}
                <form action="{{ route('admin.appointments.confirm', ['AppointmentID' => $appointment->AppointmentID]) }}" method="POST" style="display: inline;">
                    @csrf
                    <button class="btn btn-success"
                        {{ $appointment->Status != 'Chờ xác nhận' || !auth('admin')->check() ? 'disabled' : '' }}
                        title="{{ !auth('admin')->check() ? 'Bạn cần đăng nhập admin để thao tác' : '' }}">
                        ✅ Xác nhận
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    label {
        letter-spacing: 0.08em;
    }

    .badge {
        font-weight: 600;
    }

    .card {
        box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.15);
    }
</style>

@endsection