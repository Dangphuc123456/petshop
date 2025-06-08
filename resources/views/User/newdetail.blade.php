<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    <div class="box">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center mb-2" style="height: 300px;background:burlywood">
                <h2 class="text-center">{{ $newsDetail->title }}</h2>
            </div>
            <!-- Cột trái: Nội dung chi tiết -->
            <div class="col-md-8">
                <div class="news-detail shadow p-4">
                    <div class="detail mt-4">
                        <p class="fw-bold">{{ $newsDetail->content }}</p>
                        <p>{{ $newsDetail->content2 }}</p>

                        <!-- Hình ảnh và nội dung -->
                        <div class="text-center mb-4">
                            <img class="img_SP" src="{{ asset('anh/' . $newsDetail->image_url) }}" alt="Product image" height="300" width="500">
                        </div>

                        <p>{{ $newsDetail->content3 }}</p>

                        <div class="text-center mb-4">
                            <img class="img_SP" src="{{ asset('anh/' . $newsDetail->image_url2) }}" alt="Product image" height="300" width="500">
                        </div>

                        <p>{{ $newsDetail->content4 }}</p>

                        <div class="text-center mb-4">
                            <img class="img_SP" src="{{ asset('anh/' . $newsDetail->image_url3) }}" alt="Product image" height="300" width="500">
                        </div>

                        <p>{{ $newsDetail->content5 }}</p>

                        <div class="text-center mb-4">
                            <img class="img_SP" src="{{ asset('anh/' . $newsDetail->image_url4) }}" alt="Product image" height="300" width="500">
                        </div>

                        <p>{{ $newsDetail->content6 }}</p>

                        <div class="text-center mb-4">
                            <img class="img_SP" src="{{ asset('anh/' . $newsDetail->image_url5) }}" alt="Product image" height="300" width="500">
                        </div>

                        <p>{{ $newsDetail->content7 }}</p>

                        <div class="text-center mb-4">
                            <img class="img_SP" src="{{ asset('anh/' . $newsDetail->image_url6) }}" alt="Product image" height="300" width="500">
                        </div>
                        <p class="fw-bold">{{ $newsDetail->content8 }}</p>
                        <p>{{$newsDetail->author}}</p>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Tìm kiếm tin tức và địa chỉ -->
            <div class="col-md-4 shadow p-4 ">
                <h4 class="text-center">Tìm kiếm bài viết</h4>
                <div class="search-box mx-auto">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="query" class="form-control" placeholder="Tìm kiếm..." required>
                        <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="container mt-4">
                    <div class="store-system mx-auto">
                        <h4 class="fw-bold">Hệ thống cửa hàng</h4>
                        <div class="store-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Cửa Hàng Miền Bắc:</strong> 293 Minh Khai, Hai Bà Trưng, Hà Nội.
                        </div>
                        <div class="store-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Cửa Hàng Miền Nam:</strong> 1045 Đường Kha Vạn Cân, Phường An Bình, Thủ Đức, Tp.HCM.
                        </div>
                        <div class="breeding-farm">
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Trại nhân giống:</strong> Thôn Đức Hậu, Xã Đức Hòa, Sóc Sơn, Tp.Hà Nội.
                        </div>
                        <div class="contact-info">
                            <a href="tel:0964505836" class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-phone-alt"></i> 0964 505 836
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .store-system {
            background: #f2f2f2;
            padding: 15px;
            border-radius: 10px;
            max-width: 350px;
        }

        .store-location, .breeding-farm {
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
            border-left: 4px solid #000;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .contact-info {
            background: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .contact-info a {
            color: #e60000;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .contact-info i {
            color: #e60000;
        }
    </style>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>