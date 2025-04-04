<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success custom-alert" id="success-alert">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <form action="{{ route('User.booking.submit') }}" method="POST">
        @csrf
        <div class="container mt-4">
            <div class="row">
                <!-- Chọn Phòng -->
                <div class="col-md-6 shadow mb-2">
                    <h3 class="text-center text-primary">Chọn Phòng</h3>
                    <div class="d-flex flex-wrap">
                        @foreach($rooms as $room)
                        <div class="room-item">
                            <h6>Phòng {{ $room->RoomID }}</h6>
                            <p>{{ number_format($room->PricePerNight, 0, ',', '.') }}đ/ngày</p>
                            <input type="radio" name="RoomID" value="{{ $room->RoomID }}" required>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Form đặt phòng -->
                <div class="col-md-6 mb-2">
                    <div class="booking-section">
                        <h3 class="text-center text-warning">Thông Tin Đặt Phòng</h3>
                        <div class="mb-2">
                            <label class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" name="CustomerName" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="PhoneNumber" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="Email">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Ngày nhận phòng</label>
                            <input type="date" class="form-control" name="CheckInDate" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Ngày trả phòng</label>
                            <input type="date" class="form-control" name="CheckOutDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tổng tiền</label>
                            <input type="text" class="form-control" name="TotalPrice" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đặt phòng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"> </script>
</body>

</html>