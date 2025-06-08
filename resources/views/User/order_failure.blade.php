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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 300px;">
        <div class="text-center p-4" style="border-radius: 10px;">
            <div class="mb-3">
                <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
            </div>
            <h2>Thanh toán thất bại</h2>
            <p>Xin lỗi, đã xảy ra lỗi khi thanh toán. Vui lòng thử lại.</p>
            <a href="{{ route('User.home') }}" class="btn me-3" style="background-color: #ff5e00; color: #fff; border: none;">
                Trang chủ
            </a>
        </div>
    </div>
    <div>
        <div class="product-box">
            <h3>Sản Phẩm</h3>
            <div class="product-list">
                @foreach($Pets as $item)
                <div class="product">
                    <img class="img_SP" src="{{ asset('anh/' . $item->image_url) }}" alt="Product image">
                    <p>{{ $item->description }}</p>
                    <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>

                    <!-- Nút Xem chi tiết và Mua ngay -->
                    <div class="view_order">
                        <!-- Nút Xem chi tiết -->
                        <div class="detail-button-container">
                            <a href="{{ route('User.productdetails', ['pet_id' => $item->pet_id, 'description' => urlencode($item->description), 'category_id' => $item->category_id]) }}" class="add-to-cart-btn">
                                Xem chi tiết
                            </a>
                        </div>
                        <!-- Nút Mua ngay -->
                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="{{ route('buyNow', $item->pet_id) }}" method="POST">
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
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>