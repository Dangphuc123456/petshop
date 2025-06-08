<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    <div class="container my-4">
        <!-- Menu Tab -->
        <ul class="nav nav-tabs" id="bookingAppointmentTabs" role="tablist" style="cursor:pointer;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="booking-tab" data-bs-toggle="tab" data-bs-target="#booking" type="button" role="tab" aria-controls="booking" aria-selected="true">
                    Đặt Phòng
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="appointment-tab" data-bs-toggle="tab" data-bs-target="#appointment" type="button" role="tab" aria-controls="appointment" aria-selected="false">
                    Lịch Hẹn
                </button>
            </li>
        </ul>

        <!-- Nội dung tab -->
        <div class="tab-content mt-3" id="bookingAppointmentTabsContent">
            <!-- Tab Đặt Phòng -->
            <div class="tab-pane fade show active" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($completedBookings->isEmpty())
                <div class="alert alert-info text-center">Bạn chưa có lịch sử đặt phòng nào hoàn thành.</div>
                @else
                <table class="table table-striped mx-3">
                    <thead>
                        <tr>
                            <th>Mã Phòng</th>
                            <th>Ngày Nhận Phòng</th>
                            <th>Ngày Trả Phòng</th>
                            <th>Tổng Giá (VNĐ)</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completedBookings as $b)
                        <tr>
                            <td>Ph{{ $b->RoomID }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->CheckInDate)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->CheckOutDate)->format('d/m/Y') }}</td>
                            <td>{{ number_format($b->TotalPrice, 0, ',', '.') }}đ</td>
                            <td>{{ $b->BookingStatus }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

            <!-- Tab Lịch Hẹn -->
            <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($appointment->isEmpty())
                <div class="alert alert-info text-center">Bạn chưa có lịch sử dịch vụ nào hoàn thành.</div>
                @else
                <table class="table table-striped mx-3">
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
                        @foreach ($appointment as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->ServiceName }}</td>
                            <td>{{ $item->LocationName }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($item->AppointmentDate)) }}</td>
                            <td>{{ $item->Status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        <div class="mt-4 mb-4" style="margin-left: 24px;">
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