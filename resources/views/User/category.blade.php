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
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <div class="box ">
        <!-- Hiển thị danh sách danh mục con -->
        @if($relatedCategories->count() > 0)
        <div class="category-list">
            <h3>Danh mục sản phẩm</h3>
            <ul>
                @foreach($relatedCategories as $category)
                <li>
                    <a href="{{ route('User.category', ['category_id' => $category->category_id, 'category_name' => $category->category_name]) }}">
                        {{ $category->category_name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="product-container">
            @if(count($dog) > 0)
            <div class="product-box">
                <h3>🐶 Chó Cảnh</h3>
                <div id="product-list" class="product-list">
                    @foreach($dog as $item)
                    <div class="product">
                        <a href="{{ route('User.productdetails', ['pet_id' => $item->pet_id, 'description' => urlencode($item->description), 'category_id' => $item->category_id]) }}">
                            <img class="img_SP" src="{{ asset('anh/' . $item->image_url) }}" alt="Product image">
                            <p>{{ $item->description }}</p>
                            <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                        </a>

                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="{{ route('buyNow', $item->pet_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart" style="margin-right: 3px;"></i>Mua Ngay
                                </button>
                            </form>
                            @else
                            <button class="out-of-stock-btn" disabled>
                                <i class="fas fa-ban" style="margin-right: 8px; color:white;"></i>Hết hàng
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Danh sách Mèo -->
            @if(count($cats) > 0)
            <div class="product-box">
                <h3>🐱 Mèo Cảnh</h3>
                <div id="product-list" class="product-list">
                    @foreach($cats as $item)
                    <div class="product">
                        <a href="{{ route('User.productdetails', ['pet_id' => $item->pet_id, 'description' => urlencode($item->description), 'category_id' => $item->category_id]) }}">
                            <img class="img_SP" src="{{ asset('anh/' . $item->image_url) }}" alt="Product image">
                            <p>{{ $item->description }}</p>
                            <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                        </a>

                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="{{ route('buyNow', $item->pet_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart" style="margin-right: 3px;"></i>Mua Ngay
                                </button>
                            </form>
                            @else
                            <button class="out-of-stock-btn" disabled>
                                <i class="fas fa-ban" style="margin-right: 8px; color:white;"></i>Hết hàng
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Danh sách Phụ kiện -->
            @if(count($accessories) > 0)
            <div class="product-box">
                <h3>🛍️ Phụ Kiện</h3>
                <div id="product-list" class="product-list">
                    @foreach($accessories as $item)
                    <div class="product">
                        <a href="{{ route('User.productdetails', ['pet_id' => $item->pet_id, 'description' => urlencode($item->description), 'category_id' => $item->category_id]) }}">
                            <img class="product-img" src="{{ asset('anh/' . $item->image_url) }}" alt="Product image">
                            <p>{{ $item->description }}</p>
                            <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                        </a>

                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="{{ route('buyNow', $item->pet_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart" style="margin-right: 3px;"></i>Mua Ngay
                                </button>
                            </form>
                            @else
                            <button class="out-of-stock-btn" disabled>
                                <i class="fas fa-ban" style="margin-right: 8px; color:white;"></i>Hết hàng
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{asset('js/loading.js')}}"></script>
</body>

</html>