<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <form action="{{ route('User.booking.submit') }}" method="POST">
        @csrf
        <div class="container mt-4">
            <div class="row">
                <!-- Chọn Phòng -->
                <div class="col-md-6 shadow p-0 rounded overflow-hidden mb-2">
                    <div class="bg-primary py-2">
                        <h4 class="text-center mb-0" style="color: white;">Chọn Phòng</h4>
                    </div>
                    <div class="p-4 bg-white">
                        {{-- Nhóm 1: Cơ sở Miền Bắc --}}
                        <h5 class="mb-3">Cơ sở Miền Bắc</h5>
                        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                            @foreach($roomsNorth as $room)
                            <label class="room-card text-center border rounded px-2 py-2 position-relative" style="width: 110px; font-size: 13px;">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <input
                                        type="radio"
                                        name="RoomID"
                                        value="{{ $room->RoomID }}"
                                        data-price="{{ $room->PricePerNight }}"
                                        required
                                        class="me-1"
                                        style="width: 14px; height: 14px;">
                                    <strong class="mb-0">P{{ $room->RoomID }}</strong>
                                </div>
                                <p class="mb-0 text-muted">{{ number_format($room->PricePerNight, 0, ',', '.') }}đ/Ngày</p>
                            </label>
                            @endforeach

                            @foreach($occupiedNorth as $room)
                            {{-- Phòng đã đặt (Occupied) --}}
                            <div class="room-card text-center border rounded px-2 py-2 position-relative opacity-50" style="width: 110px; font-size: 13px;">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <input type="radio" disabled class="me-1" style="width: 14px; height: 14px;">
                                    <strong class="mb-0">P{{ $room->RoomID }} Đã đặt</strong>
                                </div>
                                <p class="mb-0 text-muted">{{ number_format($room->PricePerNight, 0, ',', '.') }}đ/Ngày</p>
                            </div>
                            @endforeach
                            @foreach($maintenanceNorth as $room)
                            {{-- Phòng đã đặt (Occupied) --}}
                            <div class="room-card text-center border rounded px-2 py-2 position-relative opacity-50" style="width: 110px; font-size: 13px;">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <input type="radio" disabled class="me-1" style="width: 14px; height: 14px;">
                                    <strong class="mb-0">P{{ $room->RoomID }} Bảo trì</strong>
                                </div>
                                <p class="mb-0 text-muted">{{ number_format($room->PricePerNight, 0, ',', '.') }}đ/Ngày</p>
                            </div>
                            @endforeach
                        </div>
                        {{-- Nhóm 2: Cơ sở Miền Nam --}}
                        <h5 class="mb-3">Cơ sở Miền Nam</h5>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            @foreach($roomsSouth as $room)
                            <label class="room-card text-center border rounded px-2 py-2 position-relative" style="width: 110px; font-size: 13px;">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <input
                                        type="radio"
                                        name="RoomID"
                                        value="{{ $room->RoomID }}"
                                        data-price="{{ $room->PricePerNight }}"
                                        required
                                        class="me-1"
                                        style="width: 14px; height: 14px;">
                                    <strong class="mb-0">P{{ $room->RoomID }}</strong>
                                </div>
                                <p class="mb-0 text-muted">{{ number_format($room->PricePerNight, 0, ',', '.') }}đ/Ngày</p>
                            </label>
                            @endforeach

                            @foreach($occupiedSouth as $room)
                            <div class="room-card text-center border rounded px-2 py-2 position-relative opacity-50" style="width: 110px; font-size: 13px;">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <input type="radio" disabled class="me-1" style="width: 14px; height: 14px;">
                                    <strong class="mb-0">P{{ $room->RoomID }}Đã đặt</strong>
                                </div>
                                <p class="mb-0 text-muted">{{ number_format($room->PricePerNight, 0, ',', '.') }}đ/Ngày</p>
                            </div>
                            @endforeach
                            @foreach($maintenanceSouth as $room)
                            <div class="room-card text-center border rounded px-2 py-2 position-relative opacity-50" style="width: 110px; font-size: 13px;">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <input type="radio" disabled class="me-1" style="width: 14px; height: 14px;">
                                    <strong class="mb-0">P{{ $room->RoomID }}Bải trì</strong>
                                </div>
                                <p class="mb-0 text-muted">{{ number_format($room->PricePerNight, 0, ',', '.') }}đ/Ngày</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Form đặt phòng -->
                <div class="col-lg-6 mb-2">
                    <div class="card shadow-sm border-0 rounded-3 h-100  ">
                        <div class="card-header bg-warning text-dark text-center rounded-top">
                            <h4 class="mb-0">Thông Tin Đặt Phòng</h4>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tên khách hàng</label>
                                <input type="text" class="form-control" name="CustomerName" placeholder="Nhập tên khách hàng" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Số điện thoại</label>
                                <input type="number" class="form-control" name="PhoneNumber" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" name="Email" placeholder="Nhập email của bạn">
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Ngày nhận phòng</label>
                                    <input type="date" class="form-control" name="CheckInDate" id="checkIn" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Ngày trả phòng</label>
                                    <input type="date" class="form-control" name="CheckOutDate" id="checkOut" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="LocationName" class="form-label fw-semibold">Địa chỉ gửi</label>
                                <select id="LocationName" name="LocationName" class="form-select" required>
                                    <option value="">-- Chọn cơ sở gửi --</option>
                                    <option value="Số 168 Thượng Đình - Thanh Xuân - Hà Nội">Số 168 Thượng Đình - Thanh Xuân - Hà Nội</option>
                                    <option value="294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh">294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tổng tiền</label>
                                <input type="text" class="form-control" name="TotalPrice" id="totalPrice" placeholder="Sẽ tự tính sau" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3 fw-semibold shadow-sm hover-scale">Đặt phòng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"> </script>
    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}", "Thành công", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        toastr.error("{{ session('error') }}", "Lỗi", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
        });
    </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkInInput = document.getElementById('checkIn');
            const checkOutInput = document.getElementById('checkOut');
            const priceInput = document.getElementById('totalPrice');
            const roomRadios = document.querySelectorAll('input[name="RoomID"]');

            function calculateTotal() {
                const checkIn = new Date(checkInInput.value);
                const checkOut = new Date(checkOutInput.value);

                if (isNaN(checkIn) || isNaN(checkOut) || checkOut <= checkIn) {
                    priceInput.value = 'Ngày không hợp lệ';
                    return;
                }

                const days = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));

                const selectedRoom = document.querySelector('input[name="RoomID"]:checked');
                if (!selectedRoom) {
                    priceInput.value = 'Chưa chọn phòng';
                    return;
                }

                const pricePerDay = parseInt(selectedRoom.dataset.price);

                const total = pricePerDay * days;
                priceInput.value = total.toLocaleString('vi-VN') + 'VNĐ';
            }

            checkInInput.addEventListener('change', calculateTotal);
            checkOutInput.addEventListener('change', calculateTotal);
            roomRadios.forEach(radio => {
                radio.addEventListener('change', calculateTotal);
            });
        });
    </script>
</body>

</html>