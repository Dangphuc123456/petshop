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
    @if(isset($pets) && count($pets) > 0)
    <div class="product-box">
        <p style="margin-left: 10px; text-align: left;font-size:18px">Trang Chủ/🔍Kết quả tìm kiếm cho "{{ $query }}"</p>
        <div class="product-list">
            @foreach($pets as $item)
            <div class="product">
                <a href="{{ route('User.productdetails', ['pet_id' => $item->pet_id, 'description' => urlencode($item->description), 'category_id' => $item->category_id]) }}">
                    <img class="img_SP" src="{{ asset('anh/' . ($item->image_url ?? 'default.jpg')) }}" alt="Product image">
                    <p>{{ $item->description }}</p>
                    <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                </a>

                <div class="view_order">
                    <div class="detail-button-container">
                        @if($item->quantity_in_stock > 0)
                        <form action="{{ route('buyNow', $item->pet_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="add-to-cart-btn">
                                <i class="fas fa-shopping-cart" style="margin-right: 3px;"></i>Mua ngay
                            </button>
                        </form>
                        @else
                        <button class="out-of-stock-btn" disabled>
                            <i class="fas fa-ban" style="margin-right: 8px; color:white;"></i>Hết hàng
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="product-box">
            <p style="margin-left: 10px; text-align: left;font-size:18px">Trang Chủ/🔍Kết quả tìm kiếm cho "{{ $query }}"</p>
            <p>Không tìm thấy sản phẩm nào phù hợp.</p>
        </div>
        @endif
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/loading.js') }}"></script>
</body>

</html>