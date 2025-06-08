<div class="modal-header bg-primary text-white">
    <h5 class="modal-title w-100 text-center">📋 Chi tiết đơn đặt hàng</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body px-4">
    {{-- Thông tin đơn hàng --}}
    <div class="mb-4">
        <h5 class="fw-bold border-bottom pb-2">🧾 Thông tin đơn hàng</h5>
        <div class="row">
            <div class="col-md-4 mb-2">
                <span class="fw-semibold">📅 Ngày đặt hàng:</span><br>
                {{ $purchaseOrder->order_date }}
            </div>
            <div class="col-md-4 mb-2">
                <span class="fw-semibold">💰 Tổng tiền:</span><br>
                <span class="text-danger fw-bold">{{ number_format($purchaseOrder->total_amount, 0, ',', '.') }}VNĐ</span>
            </div>
            <div class="col-md-4 mb-2">
                <span class="fw-semibold">🏢 Nhà cung cấp:</span><br>
                {{ $purchaseOrder->supplier->name }}
            </div>
            <div class="col-md-3 mb-2">
                <span class="fw-semibold">Link:</span><br>
                <a href="{{ $purchaseOrder->invoice_file }}" target="_blank" rel="noopener noreferrer">
                    {{ $purchaseOrder->invoice_file }}
                </a>
            </div>
        </div>
    </div>

    {{-- Bảng chi tiết sản phẩm --}}
    <div>
        <h5 class="fw-bold border-bottom pb-2 mb-3">📦 Chi tiết sản phẩm đặt</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>Mã thú cưng</th>
                        <th>Số lượng</th>
                        <th>Giá (đ)</th>
                        <th>Thành tiền (đ)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrderItems as $item)
                    <tr>
                        <td>{{ $item->pet_id }}</td>
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
</div>