<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')

    <div class="about">
        <div class="shadow-lg p-4 rounded w-100">
           <h3 class="text-warning fw-bold mb-3 text-center" style="font-size: 24px;">Pet Services</h3>
            <div class="row g-4">
                <!-- Khách sạn thú cưng -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('anh/ks.webp') }}" class="card-img-top" alt="Khách sạn thú cưng" style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Khách sạn thú cưng</h5>
                            <a href="{{ route('User.booking') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-bed me-2"></i>Xem phòng có sẵn
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dịch vụ spa -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('anh/dv.webp') }}" class="card-img-top" alt="Dịch vụ spa" style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Dịch vụ spa</h5>
                            <a href="{{ route('User.appointment') }}" class="btn btn-secondary mt-2">
                                <i class="fas fa-spa me-2"></i>Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
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