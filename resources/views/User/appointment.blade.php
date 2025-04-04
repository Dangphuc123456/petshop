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
    <div class="container mt-4">
        @if (session('success'))
        <div class="alert alert-success custom-alert" id="success-alert">
            {{ session('success') }}
        </div>
        @endif

        <h3 class="mb-4 text-center " style="color:orange ;">Đặt lịch hẹn</h3>
        <div class="row">
            <!-- Cột trái: Danh sách dịch vụ -->
            <div class="col-md-6 shadow mb-2">
                <h3>Danh sách dịch vụ</h3>
                @if($service->isNotEmpty())
                <div class="list-group"> <!-- Sử dụng list-group để tạo hiệu ứng box-show -->
                    @foreach($service as $item)
                    <div class="list-group-item mb-3 border rounded">
                        <h4 class="list-group-item-heading">{{ $item->ServiceID }}. {{ $item->ServiceName }}</h4>
                        <p class="mb-1"><strong>Mô tả:</strong> {{ $item->Description }}</p>
                        <p class="mb-1"><strong>Giá:</strong> {{ number_format($item->Price, 0, ',', '.') }}đ</p>
                        <p class="mb-1"><strong>Thời gian:</strong> {{ $item->ServiceDuration }} phút</p>
                    </div>
                    @endforeach
                </div>
                @else
                <p>Không có dịch vụ nào để hiển thị.</p>
                @endif
            </div>

            <!-- Cột phải: Form đặt lịch -->
            <div class="col-md-6 shadow mb-2">
                <h3>Chọn dịch vụ và điền thông tin</h3>
                <form action="{{ route('User.appointments.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="ServiceID" class="form-label">Chọn dịch vụ:</label>
                        <select id="ServiceID" name="ServiceID" class="form-select" required>
                            <option value="">-- Chọn dịch vụ --</option>
                            @foreach($service as $item)
                            <option value="{{ $item->ServiceID }}">{{ $item->ServiceName }} - {{ number_format($item->Price, 0, ',', '.') }}đ</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="LocationName" class="form-label">Chọn địa điểm:</label>
                        <select id="LocationName" name="LocationName" class="form-select" required>
                            <option value="">-- Chọn địa điểm --</option>
                            <option value="Số 168 Thượng Đình - Thanh Xuân - Hà Nội">Số 168 Thượng Đình - Thanh Xuân - Hà Nội</option>
                            <option value="294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh">294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh</option>
                            <option value="149-150 Thảo Nguyên - Ecopark - Hưng Yên">149-150 Thảo Nguyên - Ecopark - Hưng Yên</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="CustomerName" class="form-label">Tên khách hàng:</label>
                        <input type="text" id="CustomerName" name="CustomerName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="CustomerContact" class="form-label">Thông tin liên lạc:</label>
                        <input type="text" id="CustomerContact" name="CustomerContact" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="AppointmentDate" class="form-label">Ngày\giờ hẹn:</label>
                        <input type="datetime-local" id="AppointmentDate" name="AppointmentDate" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">Đặt lịch</button>
                </form>
            </div>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>