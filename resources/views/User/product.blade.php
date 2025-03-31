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
    @include('User.component.tab')
    <div class="box">
        <!-- Hiển thị danh sách danh mục con -->
        <div class="category-list" style="height:800px">
            <h3>Danh mục sản phẩm</h3>
            <ul>
                @foreach($relatedCategories as $category)
                <li>
                    <a href="{{ route('User.category', ['category_id' => $category->category_id]) }}">
                        {{ $category->category_name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        
        <div class="product-container">
        <!-- Danh sách Chó -->
        <div class="product-box">
            <h3 id="product-section">{{ $title }}</h3>
            <div class="product-list">
                @foreach($products as $item)
                <div class="product">
                <img class="img_SP" src="{{ asset('anh/' . $item->image_url) }}" alt="Product image">
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