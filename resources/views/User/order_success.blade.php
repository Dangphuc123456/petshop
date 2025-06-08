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
    <div class="container d-flex justify-content-center mt-4" style="margin-top: 80px;margin-bottom:60px">
        <div class="text-center p-4 " style="max-width: 600px; width: 100%;">
            <div class="mb-2">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            </div>
            <h2> Đặt hàng thành công</h2>
            <p>Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi.</p>

            @if($order->payment === 'cash')
            <p>Đơn hàng của bạn đã được ghi nhận và sẽ được xử lý trong thời gian sớm nhất. Vui lòng thanh toán khi nhận hàng.</p>
            @else
            <p>Đơn hàng của bạn đã được thanh toán thành công. Chúng tôi sẽ tiến hành xử lý và giao hàng sớm nhất có thể.</p>
            @endif

            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('User.home') }}" class="btn me-3" style="background-color: #ff5e00; color: #fff; border: none;">
                    Trang chủ
                </a>
                <a href="{{ route('User.orders.pending') }}" class="btn btn-success">Đơn hàng</a>
            </div>
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
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>