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
    @include('User.component.tab')
    <div class="content">
        <h3>Sơ lược về Pet-Shop</h3>
        <p class="about-text">
            Pet House là trại nhân giống thú cảnh lớn tại Việt Nam và đồng thời là hệ thống cửa hàng cung cấp phụ kiện,
            dịch vụ chăm sóc làm đẹp thú cưng & khách sạn thú cưng.
        </p>
        <p class="about-text">
            Với sự đa dạng về các giống chó mèo cảnh, chúng tôi đảm bảo chất lượng con giống, nguồn gen chuẩn cùng quy trình
            nhân giống chuyên nghiệp. Tại Pet House, các con giống đều là dòng thuần chủng, được chăm sóc kỹ lưỡng và có sức khỏe tốt,
            sẵn sàng về nhà mới.
        </p>
        <a href="{{ route('User.about') }}" class="btn-detail">TÌM HIỂU CHI TIẾT +</a>
    </div>
    <div class="product-container">
        <!-- Danh sách Chó -->
        <div class="product-box">
            <h3>🐶 Chó Cảnh</h3>
            <div class="product-list">
                @foreach($dog as $item)
                <div class="product">
                    @if(isset($item->image_url))
                    <img class="img_SP" src="anh/{{$item->image_url}}" alt="Product image">
                    @else
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                    @endif
                    <p>{{ $item->description }}</p>
                    <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>

                    <!-- Nút Xem chi tiết và Mua ngay -->
                    <div class="view_order">
                        <!-- Nút Xem chi tiết -->
                        <div class="detail-button-container">
                            <a href="{{ route('User.productdetails', $item->pet_id) }}" class="add-to-cart-btn">
                                Xem chi tiết
                            </a>
                        </div>
                        <!-- Nút Mua ngay -->
                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="#" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    Mua ngay
                                </button>
                            </form>
                            @else
                            <button class="out-of-stock-btn" disabled>
                                Hết hàng
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('User.product', ['type' => 'dogs']) }}"><button class="see-more">Xem thêm</button></a>
        </div>

        <!-- Danh sách Mèo -->
        <div class="product-box">
            <h3>🐱 Mèo Cảnh</h3>
            <div class="product-list">
                @foreach($cats as $item)
                <div class="product">
                    @if(isset($item->image_url))
                    <img class="img_SP" src="anh/{{$item->image_url}}" alt="Product image">
                    @else
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                    @endif
                    <p>{{ $item->description }}</p>
                    <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>

                    <!-- Nút Xem chi tiết và Mua ngay -->
                    <div class="view_order">
                        <div class="detail-button-container">
                            <a href="{{ route('User.productdetails', $item->pet_id) }}" class="add-to-cart-btn">
                                Xem chi tiết
                            </a>
                        </div>
                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="#" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    Mua ngay
                                </button>
                            </form>
                            @else
                            <button class="out-of-stock-btn" disabled>
                                Hết hàng
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('User.product', ['type' => 'cats']) }}"><button class="see-more">Xem thêm</button></a>
        </div>

        <!-- Danh sách Phụ kiện -->
        <div class="product-box">
            <h3>🛍️ Phụ Kiện</h3>
            <div class="product-list">
                @foreach($accessories as $item)
                <div class="product">
                    @if(isset($item->image_url))
                    <img class="img_SP" src="anh/{{$item->image_url}}" alt="Product image">
                    @else
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                    @endif
                    <p>{{ $item->description }}</p>
                    <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>

                    <!-- Nút Xem chi tiết và Mua ngay -->
                    <div class="view_order">
                        <div class="detail-button-container">
                            <a href="{{ route('User.productdetails', $item->pet_id) }}" class="add-to-cart-btn">
                                Xem chi tiết
                            </a>
                        </div>
                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="#" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    Mua ngay
                                </button>
                            </form>
                            @else
                            <button class="out-of-stock-btn" disabled>
                                Hết hàng
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('User.product', ['type' => 'accessories']) }}"><button class="see-more">Xem thêm</button></a>
        </div>
    </div>
    <div class="product-box">
        <h3>📰Tin Tức</h3>
        <div class="news">
            @foreach($news as $new)
            <div class="news-item">
                <div class="date">{{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y') }}</div>
                <img class="img_SP" src="{{ asset('anh/' . $new->image_url) }}" alt="Product image">
                <div class="date">{{ $new->create_at }}</div>
                <div class="Main-content">
                    <h2>{{ $new->title }}</h2>
                    <p>{{ $new->content }}</p>
                    <a href="{{ route('User.newdetail', ['id' => $new->id]) }}" class="read-more">Đọc chi tiết</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>