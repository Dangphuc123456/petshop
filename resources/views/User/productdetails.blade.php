<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/productdetails.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <div class="box ">
        <!-- Hiển thị danh sách danh mục con -->
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
        <div class="product-details">
            <form action="{{ route('cart.add', $products->pet_id) }}" method="POST">
                @csrf
                <div class="product-view">
                    <div class="product-image">
                        <img class="img_SP" src="{{ asset('anh/' . $products->image_url) }}" alt="Product image">
                    </div>
                    <div class="product-information">
                        <h2>{{$products->description}}</h2>
                        <p class="rating">Chưa Có Đánh Giá | <strong>{{ $products->quantity_sold }}</strong> Sold</p>
                        <p class="price">{{ number_format($products->price, 0, ',', '.') }} VNĐ</p>
                        <p class="sex">Giới tính: <span style="color: black; margin-left:10px;">{{ $products->gender }}</span><span style="margin-left: 30px;">Mã ID:{{ $products->pet_id }}</span></->
                        <div class="category">
                            <label for="category">Danh mục: <span>{{ $products->species }}</span>-<span>{{ $products->breed }}</span></label>
                        </div>
                        <div class="status">
                            <label for="status">Tình trạng: <span style="color: #696969; margin-left:10px;">{{ $products->status ?? 'Chưa xác định' }}</span></label>
                        </div>
                        <div class="status">
                            <label for="status">Vận chuyển: 🚚 Miễn phí trong bán kính 50km</label>
                        </div>
                        <div class="quantity">
                            <label for="quantity">Số lượng:{{ $products->quantity_in_stock }} <strong style="margin-left: 10px;">Đã bán:{{ $products->quantity_sold }}</strong> </label>
                        </div>
                        @if($products->quantity_in_stock > 0)
                        <div class="quantity">
                            <label for="quantity">Số lượng:</label>
                            <div class="quantity-control">
                                <button type="button" onclick="decreaseQuantity()">-</button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $products->quantity_in_stock }}" required />
                                <button type="button" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                        <button type="submit" class="add-to-cart-btn" style="width:300px; margin-top: 10px;padding:10px">
                            MUA HÀNG
                        </button>
                        @else
                        <button class="out-of-stock-btn" disabled>
                            Hết hàng
                        </button>
                        @endif
                        <div class="transport">
                            <h7>Lưu ý: Giá sản phẩm có thể thay đổi theo từng thời điểm.<span class="add">
                                    <a href="https://zalo.me/0964505836" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                                        Kết Bạn Zalo
                                    </a>
                                </span>
                                hoặc
                                <span class="call">
                                    <a href="tel:0964505836" style="text-decoration: none;color:red">
                                        Gọi Hotline
                                    </a>
                                </span> để xem thêm hình ảnh/video chi tiết.
                            </h7>
                        </div>
                    </div>
                </div>
            </form>
            <div class="product-container">
                <div class="product-box">
                    <h3>Sản phẩm tương tự</h3>
                    <div class="product-list">
                        @foreach($similarProducts as $item)
                        <div class="product">
                            <!-- Bọc phần hình ảnh, mô tả và giá trong thẻ <a> -->
                            <a href="{{ route('User.productdetails', ['pet_id' => $item->pet_id, 'description' => urlencode($item->description), 'category_id' => $item->category_id]) }}">
                                <img class="img_SP" src="{{ asset('anh/' . $item->image_url) }}" alt="Product image">
                                <p>{{ $item->description }}</p>
                                <span class="price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                            </a>

                            <!-- Hiển thị nút Mua ngay hoặc Hết hàng -->
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"> </script>
    <script src="{{ asset('js/loading.js') }}"></script>
    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}", "Thành công", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        toastr.error("{{ session('error') }}", "Lỗi", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
        });
    </script>
    @endif
</body>

</html>