@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h1 class="h3 mb-0"> 📋Chi tiết Phòng</h1>
        </div>
        <div class="card-body">
            <div class="row mb-4 text-dark">
                <!-- Room ID -->
                <div class="col-md-4 mb-2">
                    <div class="d-flex align-items-center rounded p-2 shadow-sm">
                        <strong class="me-2 ">Room ID:</strong>
                        <span>{{ $room->RoomID }}</span>
                    </div>
                </div>

                <!-- Giá mỗi đêm -->
                <div class="col-md-4 mb-2">
                    <div class="d-flex align-items-center rounded p-2 shadow-sm">
                        <strong class="me-2 ">Giá mỗi đêm:</strong>
                        <span class="text-danger fw-bold">{{ number_format($room->PricePerNight, 0, ',', '.') }} đ</span>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="d-flex align-items-center rounded p-2 shadow-sm">
                        <strong class="me-2 ">Miền :</strong>
                        <span class="text-danger fw-bold">{{ $room->Region }}</span>
                    </div>
                </div>
                <!-- Trạng thái -->
                <div class="col-md-4 mb-2">
                    <div class="d-flex align-items-center rounded p-2 shadow-sm">
                        <strong class="me-2 ">Trạng thái:</strong>
                        @if(strtolower($room->Status) == 'available')
                        <span class="badge bg-success px-3 py-1">{{ $room->Status }}</span>
                        @elseif(strtolower($room->Status) == 'booked')
                        <span class="badge bg-warning text-dark px-3 py-1">{{ $room->Status }}</span>
                        @else
                        <span class="badge bg-secondary px-3 py-1">{{ $room->Status }}</span>
                        @endif
                    </div>
                </div>
            </div>


            <h2 class="h4 mb-3">Danh sách đặt phòng</h2>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Booking ID</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày nhận phòng</th>
                            <th>Ngày trả phòng</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                        <tr>
                            <td>Lần {{ $booking->BookingID }}</td>
                            <td>{{ $booking->CustomerName }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->CheckInDate)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->CheckOutDate)->format('d/m/Y') }}</td>
                            <td class="text-danger fw-bold">{{ number_format($booking->TotalPrice, 0, ',', '.') }} đ</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Chưa có đặt phòng nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.room.index') }}" class="btn btn-outline-secondary mt-3">
                <i class="bi bi-arrow-left"></i>← Quay lại danh sách phòng
            </a>
        </div>
    </div>
</div>
@endsection