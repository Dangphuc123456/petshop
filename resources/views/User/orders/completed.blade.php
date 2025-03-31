<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <div class="order-history">
        <h3>📋Lich Sử Đơn Hàng</h3>
        @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="order-card" id="order-{{ $order->id }}">
            <div class="orders-status">Trạng thái | <span class="status">{{ $order->status }}</span></div>
            <hr style="margin: 5px 0;">
            @foreach($order->items as $item)
            <div class="order-item" id="item-{{ $item->id }}">
                <img src="{{ asset('anh/' . $item->image_url) }}" alt="{{ $item->description }}" class="order-item-img">

                <div class="product-info">
                    <h3 class="product-name">{{ $item->description }}</h3>
                    <p class="product-quantity">x{{ $item->quantity }}</p>
                </div>

                <div class="product-price">
                    <p class="discounted-price">{{ number_format($item->price, 0, ',', '.') }} VND</p>
                </div>
            </div>
            @endforeach
            <div class="order-footer">
                <p class="total-price">Thành tiền: <span>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</span></p>
                <div class="order-actions">
                    <button class="buy-again">Mua Lại</button>
                    <button class="contact-seller">Liên Hệ Người Bán</button>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p class="text-center">Bạn chưa có đơn hàng nào hoàn thành.</p>
        @endif
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>