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

    
    @if(isset($pets) && count($pets) > 0)
    <div class="product-box">
    <h4>🔍 "{{ $query }}"</h4>
        <div class="product-list">
            @foreach($pets as $item)
            <div class="product">
                <!-- Ảnh sản phẩm -->
                <img class="img_SP" src="{{ asset('anh/' . ($item->image_url ?? 'default.jpg')) }}" alt="Product image">

                <!-- Mô tả và giá sản phẩm -->
                <p>{{ $item->description }}</p>
                <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>

                <!-- Nút Xem chi tiết và Mua ngay -->
                <div class="view_order">
                    <div class="detail-button-container">
                        <a href="{{ route('User.productdetails', $item->pet_id) }}" class="add-to-cart-btn">Xem chi tiết</a>
                    </div>
                    <div class="detail-button-container">
                        @if($item->quantity_in_stock > 0)
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit" class="add-to-cart-btn">Mua ngay</button>
                        </form>
                        @else
                        <button class="out-of-stock-btn" disabled>Hết hàng</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p>Không tìm thấy sản phẩm nào phù hợp.</p>
        @endif
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>