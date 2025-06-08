<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    <div class="container my-4">
        <h3>📋 Lịch Sử Đơn Hàng</h3>

        <ul class="nav nav-tabs" id="orderStatusTabs" role="tablist" style="cursor:pointer;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button"
                    role="tab" aria-controls="completed" aria-selected="true">Đơn hàng đã hoàn thành</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button"
                    role="tab" aria-controls="cancelled" aria-selected="false">Đơn hàng đã hủy</button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="orderStatusTabsContent">
            {{-- Tab Hoàn thành --}}
            <div class="tab-pane fade show active" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                @if($completedOrders->count() > 0)
                @foreach($completedOrders as $order)
                <div class="order-card mb-3 p-3 border rounded" id="order-{{ $order->order_id }}">
                    <div class="orders-status mb-2 text-end" style="padding-right: 10px;">
                        Trạng thái | <span class="status completed fw-bold">{{ $order->status }}</span>
                    </div>
                    <hr style="margin: 5px 0;">
                    @foreach($order->orderItems as $item)
                    <div class="order-item d-flex align-items-center mb-2" id="item-{{ $item->order_item_id }}">
                        <img src="{{ asset('anh/' . $item->image_url) }}" alt="{{ $item->description }}"
                            class="order-item-img me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="product-info flex-grow-1">
                            <h5 class="product-name mb-1">{{ $item->description }}</h5>
                            <p class="product-quantity mb-0">Số lượng: x{{ $item->quantity }}</p>
                        </div>
                        <div class="product-price text-end" style="min-width: 120px;">
                            <p class="discounted-price mb-0">{{ number_format($item->price, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="order-footer d-flex justify-content-between align-items-center mt-3">
                        <p class="total-price mb-0">
                            Thành tiền: <span class="fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</span>
                        </p>
                        <div class="order-actions">
                            @foreach($order->orderItems as $item)
                            @if($item->inventory > 0)
                            <form action="{{ route('User.order.reorder', $item->product_id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-shopping-cart"></i> Mua Lại
                                </button>
                            </form>
                            @endif
                            @endforeach
                            <a href="tel:0964505836" class="btn btn-primary">
                                <i class="fas fa-phone"></i> Liên Hệ Người Bán
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-center">Bạn chưa có đơn hàng đã hoàn thành.</p>
                @endif
            </div>

            {{-- Tab Đã hủy --}}
            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                @if($cancelledOrders->count() > 0)
                @foreach($cancelledOrders as $order)
                <div class="order-card mb-3 p-3 border rounded" id="order-{{ $order->order_id }}">
                    <div class="orders-status mb-2 text-end" style="padding-right: 10px;">
                        Trạng thái | <span class="status cancelled fw-bold" style="background-color: red;color:white;">{{ $order->status }}</span>
                    </div>
                    <hr style="margin: 5px 0;">
                    @foreach($order->orderItems as $item)
                    <div class="order-item d-flex align-items-center mb-2" id="item-{{ $item->order_item_id }}">
                        <img src="{{ asset('anh/' . $item->image_url) }}" alt="{{ $item->description }}"
                            class="order-item-img me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="product-info flex-grow-1">
                            <h5 class="product-name mb-1">{{ $item->description }}</h5>
                            <p class="product-quantity mb-0">Số lượng: x{{ $item->quantity }}</p>
                        </div>
                        <div class="product-price text-end" style="min-width: 120px;">
                            <p class="discounted-price mb-0">{{ number_format($item->price, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="order-footer d-flex justify-content-between align-items-center mt-3">
                        <p class="total-price mb-0">
                            Thành tiền: <span class="fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</span>
                        </p>
                        <div class="order-actions">
                            <a href="tel:0964505836" class="btn btn-primary">
                                <i class="fas fa-phone"></i> Liên Hệ Người Bán
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-center">Bạn chưa có đơn hàng đã bị hủy.</p>
                @endif
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