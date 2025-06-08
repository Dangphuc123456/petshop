<div class="modal-header bg-warning">
    <h5 class="modal-title">Chỉnh sửa đơn hàng #{{ $purchase->purchase_order_id }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form action="{{ route('admin.inputinvoi.update', $purchase->purchase_order_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="order_date" class="form-label">Order Date</label>
                    <input type="date" class="form-control" name="order_date" id="order_date"
                        value="{{ old('order_date', $purchase->order_date ? $purchase->order_date->format('Y-m-d') : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select class="form-control" name="supplier_id" id="supplier_id" required>
                        <option value="" disabled>Select Supplier</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <p class="form-control-plaintext">{{ number_format($purchase->total_amount, 0, ',', '.') }} VNĐ</p>
                </div>
                <div class="mb-3">
                    <label for="invoice_file" class="form-label">Link</label>
                    <input type="text" class="form-control" name="invoice_file" id="invoice_file">
                </div>

            </div>
        </div>

        <hr>

        <h5>Chi tiết sản phẩm đặt</h5>

        <div id="items-wrapper">
            @php
            $oldItems = old('items', []);
            $items = count($oldItems) ? $oldItems : $purchaseOrderItems->toArray();
            @endphp

            @foreach($items as $index => $item)
            <div class="row mb-3 item-row">
                <div class="col-md-3">
                    <label class="form-label">Pet</label>
                    <select name="items[{{ $index }}][pet_id]" class="form-control" required>
                        <option value="" disabled>Select Pet</option>
                        @foreach($pets as $pet)
                        <option value="{{ $pet->pet_id }}">{{ $pet->description }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="items[{{ $index }}][quantity]" class="form-control" min="1" required
                        value="{{ $item['quantity'] ?? 1 }}" readonly>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" name="items[{{ $index }}][price]" class="form-control" min="0" required
                        value="{{ $item['price'] ?? 0 }}" readonly>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-save me-1"></i> Cập nhật
            </button>
        </div>
    </form>
</div>