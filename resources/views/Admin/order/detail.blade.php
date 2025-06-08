@extends('Admin.admin')
@section('title', 'Chi tiết đơn hàng')
@section('main')
<div class="container mt-4 border border-gray-500 mb-4">
    <h2 class="text-center mb-4 ">📋 Chi tiết đơn đặt hàng</h2>
    {{-- Thông tin đơn hàng --}}
    <div class="mb-5">
        <h5 class="fw-bold border-bottom pb-2">🧾 Thông tin đơn hàng{{ $order->order_id }}</h5>
        <div class="row mb-3 ms-4">
            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">📅 Ngày đặt hàng:</span>
                {{ $order->order_date }}
            </div>
            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">💰 Tổng tiền:</span>
                <span class="text-danger fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }} đ</span>
            </div>

            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">📞 Số điện thoại:</span>
                {{ $order->phone }}
            </div>
            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">🏠 Địa chỉ:</span>
                {{ $order->address }}
            </div>

            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">✉️ Email:</span>
                {{ $order->email }}
            </div>
            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">🔢 Mã bưu điện:</span>
                {{ $order->postal_code }}
            </div>

            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">💳 Phương thức thanh toán:</span>
                {{ $order->payment }}
            </div>
            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">📦 Trạng thái:</span>
                <span class="badge 
                    @if($order->status == 'Đang xử lý') bg-warning 
                    @elseif($order->status == 'Đã giao') bg-success 
                    @elseif($order->status == 'Đã hủy') bg-danger 
                    @else bg-secondary @endif">
                    {{ $order->status }}
                </span>
            </div>
            <div class="col-md-6 bg-light p-2 mb-2">
                <span class="fw-semibold">Lý do hủy:</span>
                {{ $order->cancel_reason }}
            </div>
        </div>
    </div>

    {{-- Bảng chi tiết sản phẩm --}}
    <div>
        <h5 class="fw-bold border-bottom pb-2 mb-2">📦 Chi tiết sản phẩm đặt</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>Ảnh</th>
                        <th>Mã thú cưng</th>
                        <th>Mô tả</th>
                        <th>Số lượng</th>
                        <th>Giá (đ)</th>
                        <th>Thành tiền (đ)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_items as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('anh/' . $item->image_url) }}" alt="Ảnh sản phẩm" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                        </td>
                        <td>{{ $item->pet_id }}</td>
                        <td class="text-start">{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-end text-danger fw-semibold">
                            {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-light text-center rounded-bottom-4 mb-2">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            {{-- Nút quay lại --}}
            <form style="margin: 0;">
                @if (auth('admin')->check())
                {{-- Nút quay lại danh sách --}}
                <button formaction="{{ route('admin.order.index') }}" type="submit" class="btn btn-outline-primary fw-semibold px-4" style="font-size: 16px;">
                    ← Quay lại danh sách
                </button>
                @else
                {{-- Chỉ hiện nút quay lại danh sách nếu chưa đăng nhập --}}
                <button formaction="{{ route('admin.login') }}" type="submit" class="btn btn-outline-primary fw-semibold px-4" style="font-size: 16px;">
                    ← Đăng nhập để sử dụng
                </button>
                @endif
            </form>
            {{-- Nút xác nhận --}}
            <form action="{{ route('admin.order.confirm', ['order_id' => $order->order_id]) }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit"
                    class="btn btn-success fw-semibold px-4"
                    style="font-size: 16px;"
                    {{ in_array($order->status, ['Đã xác nhận', 'Đang giao hàng', 'Hoàn thành']) || !auth('admin')->check() || $order->cancel_reason ? 'disabled' : '' }}
                    title="
                        @if(!auth('admin')->check()) Vui lòng đăng nhập với tư cách Admin để xác nhận đơn hàng
                        @elseif($order->cancel_reason) Đơn hàng đã bị hủy: {{ $order->cancel_reason }}
                        @endif
                    ">
                    ✅ Xác nhận
                </button>
            </form>

        </div>
    </div>
</div>
@endsection