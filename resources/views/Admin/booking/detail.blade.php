@extends('Admin.admin')
@section('title', 'Chi Tiết Đặt Phòng')
@section('main')

<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h3 class="mb-0 text-center fw-bold" style="font-size: 18px;">
                📋 Chi Tiết Đặt Phòng
            </h3>
        </div>

        <div class="card border-0 shadow-sm p-4 bg-light rounded">
            <h5 class="mb-4 fw-bold text-primary">Thông tin đặt phòng</h5>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Phòng:</label>
                <div class="col-sm-9">
                    <span class="text-muted">#{{ $booking->RoomID }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Tên khách hàng:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $booking->CustomerName }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Số điện thoại:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $booking->PhoneNumber }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Email:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $booking->Email }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Ngày nhận phòng:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ \Carbon\Carbon::parse($booking->CheckInDate)->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Ngày trả phòng:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ \Carbon\Carbon::parse($booking->CheckOutDate)->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Trạng thái:</label>
                <div class="col-sm-9">
                    @php
                    $status = $booking->BookingStatus;
                    $badgeClass = match ($status) {
                    'Đã xác nhận' => 'badge bg-success',
                    'Đã hủy' => 'badge bg-danger',
                    'Đã trả phòng' => 'badge bg-secondary',
                    default => 'badge bg-warning text-dark',
                    };
                    @endphp
                    <span class="{{ $badgeClass }} px-3 py-2 rounded-pill">{{ $status }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Lý do hủy:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ $booking->CancellationReason }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Ngày đăng ký:</label>
                <div class="col-sm-9">
                    <span class="text-muted">{{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 fw-bold text-dark">Tổng tiền:</label>
                <div class="col-sm-9">
                    <span class="text-danger fw-bold">{{ number_format($booking->TotalPrice, 0, ',', '.') }} VNĐ</span>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-center rounded-bottom-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                {{-- Nút quay lại --}}
                <a href="{{ route('admin.booking.index') }}"
                    class="btn btn-outline-primary fw-semibold px-4 {{ Auth::guard('admin')->check() ? '' : 'disabled' }}"
                    style="font-size: 16px;"
                    @if(!Auth::guard('admin')->check())
                    style="pointer-events: none;"@endif>
                    ← Quay lại danh sách
                </a>
                {{-- Nút xác nhận --}}
                <form action="{{ route('admin.booking.confirm', ['BookingID' => $booking->BookingID]) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        class="btn btn-success"
                        @if(
                        $booking->BookingStatus !== 'Chờ xác nhận' ||
                        !auth('admin')->check()
                        )
                        disabled
                        @endif
                        title="@if(!auth('admin')->check()) Bạn cần đăng nhập admin để thực hiện thao tác này @endif">
                        ✅ Xác nhận
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    h6 {
        letter-spacing: 0.05em;
    }

    .badge {
        font-weight: 600;
    }

    .card {
        box-shadow: 0 0.5rem 1rem rgba(0, 123, 255, 0.15);
    }
</style>

@endsection