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

    <div class="container about">
        <div class="service">
            <h2 class="text-center" style="color: orange;">Pet Services</h2>
            <div class="row services-list">
                <!-- Khách sạn thú cưng -->
                <div class="col-md-6 service-item mb-4">
                    <div class="card">
                        <img src="{{ asset('anh/ks.webp') }}" class="card-img-top" alt="Khách sạn thú cưng" style="height: 300px; width: 100%; object-fit: cover;">
                        <div class="card-body text-center">
                            <h2 class="card-title">Khách sạn thú cưng</h2>
                            <a href="{{ route('User.booking') }}" class="btn btn-primary">View Available Rooms</a>
                        </div>
                    </div>
                </div>
                <!-- Dịch vụ spa -->
                <div class="col-md-6 service-item mb-4">
                    <div class="card">
                        <img src="{{ asset('anh/dv.webp') }}" class="card-img-top" alt="Dịch vụ spa" style="height: 300px; width: 100%; object-fit: cover;">
                        <div class="card-body text-center">
                            <h2 class="card-title">Dịch vụ spa</h2>
                            <a href="{{ route('User.appointment') }}" class="btn btn-secondary">Xem chi tiết</a>
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