<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đơn hàng | PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>
    @include('User.component.header')
    <div class="container my-4">
        <h3>📦 Đơn Hàng</h3>
        <ul class="nav nav-tabs" id="orderStatusTabs" role="tablist" style="cursor:pointer;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button"
                    role="tab" aria-controls="pending" aria-selected="true">Chờ xác nhận</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="confirmed-tab" data-bs-toggle="tab" data-bs-target="#confirmed" type="button"
                    role="tab" aria-controls="confirmed" aria-selected="false">Đã xác nhận</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="delivering-tab" data-bs-toggle="tab" data-bs-target="#delivering" type="button"
                    role="tab" aria-controls="delivering" aria-selected="false">Đang giao hàng</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-3" id="orderStatusTabsContent">
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">

                @if($pendingOrders->count() > 0)
                @foreach($pendingOrders as $order)
                <div class="order-card mb-3 p-3 border rounded" id="order-{{ $order->order_id }}">
                    <div class="orders-status mb-2 text-end" style="padding-right: 10px;">
                        Trạng thái | <span class="status fw-bold">{{ $order->status }}</span>
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
                            <button type="button" class="btn btn-danger btn-cancel-order" data-url="{{ route('User.order.cancel', $order->order_id) }}" data-order-id="{{ $order->order_id }}">
                                <i class="fas fa-times-circle"></i> Hủy Đơn Hàng
                            </button>
                            <a href="tel:0964505836" class="btn btn-primary">
                                <i class="fas fa-phone"></i> Liên Hệ Người Bán
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-center">Không có đơn hàng nào đang chờ xác nhận hoặc đã thanh toán.</p>
                @endif
            </div>

            <!-- Đã xác nhận -->
            <div class="tab-pane fade" id="confirmed" role="tabpanel" aria-labelledby="confirmed-tab">

                @if($confirmedOrders->count() > 0)
                @foreach($confirmedOrders as $order)
                <div class="order-card mb-3 p-3 border rounded" id="order-{{ $order->order_id }}">
                    <div class="orders-status mb-2 text-end" style="padding-right: 10px;">
                        Trạng thái | <span class="status fw-bold">{{ $order->status }}</span>
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
                <p class="text-center">Không có đơn hàng nào đã xác nhận.</p>
                @endif

            </div>

            <!-- Đang giao hàng -->
            <div class="tab-pane fade" id="delivering" role="tabpanel" aria-labelledby="delivering-tab">

                @if($deliveringOrders->count() > 0)
                @foreach($deliveringOrders as $order)
                <div class="order-card mb-3 p-3 border rounded" id="order-{{ $order->order_id }}">
                    <div class="orders-status mb-2 text-end" style="padding-right: 10px;">
                        Trạng thái | <span class="status fw-bold">{{ $order->status }}</span>
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
                <p class="text-center">Không có đơn hàng nào đang giao.</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal Hủy Đơn Hàng -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="cancelOrderForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelOrderModalLabel">Lý do hủy đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cancel_reason" class="form-label">Chọn lý do:</label>
                            <select name="cancel_reason" id="cancel_reason" class="form-select" required>
                                <option value="">-- Vui lòng chọn lý do --</option>
                                <option value="Thay đổi địa điểm">Thay đổi địa điểm nhận hàng</option>
                                <option value="Thay đổi sản phẩm">Thay đổi sản phẩm</option>
                                <option value="Sai thông tin đơn hàng">Sai thông tin đơn hàng</option>
                                <option value="Thời gian giao hàng lâu">Thời gian giao hàng lâu</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="mb-3" id="otherReasonBox" style="display: none;">
                            <label for="other_reason" class="form-label">Nhập lý do khác:</label>
                            <input type="text" name="other_reason" id="other_reason" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelButtons = document.querySelectorAll('.btn-cancel-order');
            const cancelForm = document.getElementById('cancelOrderForm');
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));
            const cancelReason = document.getElementById('cancel_reason');
            const otherReasonBox = document.getElementById('otherReasonBox');
            const otherReasonInput = document.getElementById('other_reason');

            cancelButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const url = button.getAttribute('data-url');
                    cancelForm.setAttribute('action', url);
                    cancelModal.show();
                });
            });

            cancelReason.addEventListener('change', () => {
                otherReasonBox.style.display = cancelReason.value === 'Khác' ? 'block' : 'none';
            });

            cancelForm.addEventListener('submit', function(e) {
                if (cancelReason.value === 'Khác' && !otherReasonInput.value.trim()) {
                    e.preventDefault();
                    alert('Vui lòng nhập lý do khác.');
                }
            });
        });
    </script>
</body>

</html>