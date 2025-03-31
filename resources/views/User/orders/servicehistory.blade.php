<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <div class="about">
        <h3 class="mb-4 mt-4" style="margin-left: 24px;">📅Lịch sử Đặt Phòng vs Dịch vụ</h3>
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($completedBookings->isEmpty())
        <div class="alert alert-info" style="text-align: center;">Bạn chưa có lịch sử đặt phòng nào.</div>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Phòng Đặt</th>
                    <th>Ngày Nhận Phòng</th>
                    <th>Ngày Trả Phòng</th>
                    <th>Tổng Giá (VNĐ)</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completedBookings as $b)
                <tr>
                    <td>P{{ $b->BookingID }}</td>
                    <td>{{ \Carbon\Carbon::parse($b->CheckInDate)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($b->CheckOutDate)->format('d/m/Y') }}</td>
                    <td>{{ number_format($b->TotalPrice, 0, ',', '.') }}đ</td>
                    <td>{{ $b->BookingStatus }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <!-- dịch vụ -->
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($appointment->isEmpty())
        <div class="alert alert-info" style="text-align: center;">Bạn chưa có lịch sử dịch vụ nào.</div>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dịch vụ</th>
                    <th>Địa điểm</th>
                    <th>Ngày hẹn/Giờ</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointment as $index => $appointment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $appointment->ServiceName }}</td>
                    <td>{{ $appointment->LocationName }}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($appointment->AppointmentDate)) }}</td>
                    <td>{{ $appointment->Status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Bạn chưa có lịch hẹn nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endif
        <div class="mt-4 mb-4 " style="margin-left: 24px;">
            <a href="{{ route('User.home') }}" class="btn btn-primary">Quay lại trang chủ</a>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>