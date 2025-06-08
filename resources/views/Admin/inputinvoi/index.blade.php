@extends('Admin.admin')
@section('title', 'List Purchase Order')
@section('main')

<div class="table-container">
    <h2 class="table-title">Danh sách đơn hàng nhập</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPurchaseModal">
        <i class="fas fa-plus"></i> ADD
    </button>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Nhà cung cấp</th>
                <th>Ngày đặt hàng</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrders as $po)
            <tr class="text-center align-middle">
                <td>{{ ($purchaseOrders->currentPage() - 1) * $purchaseOrders->perPage() + $loop->iteration }}</td>
                <td>{{ $po->supplier->name ?? 'N/A' }} ({{ $po->supplier->supplier_id ?? 'N/A' }})</td>
                <td>{{ \Carbon\Carbon::parse($po->order_date)->format('d/m/Y') }}</td>
                <td>{{ number_format($po->total_amount, 0, ',', '.') }}đ</td>
                <td class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-warning btn-edit" data-id="{{ $po->purchase_order_id }}" style="padding:8px;">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-success btn-detail" data-id="{{ $po->purchase_order_id }}" style="padding:8px;background-color: rgb(51, 102, 204); color:black;">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button type="button"
                        class="btn btn-danger btn-delete"
                        data-url="{{ route('inputinvoi.destroy', $po->purchase_order_id) }}"
                        title="Xóa" style="padding:8px;">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center align-items-center flex-wrap gap-3 py-3">
    {{-- Chọn số bản ghi --}}
    <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center gap-2 mb-0">
        <label for="perPageSelect" class="mb-0 small">Hiển thị:</label>
        <select name="perPage" id="perPageSelect"
            class="form-select form-select-sm"
            style="width:auto"
            onchange="this.form.submit()">
            @foreach([10,20,30,40,50] as $size)
            <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                {{ $size }}
            </option>
            @endforeach
        </select>
    </form>

    {{-- Thanh phân trang --}}
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm mb-0">
            {{-- Prev --}}
            <li class="page-item {{ $purchaseOrders->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $purchaseOrders->previousPageUrl() }}">&laquo;</a>
            </li>

            {{-- Số trang --}}
            @for ($i = 1; $i <= $purchaseOrders->lastPage(); $i++)
                <li class="page-item {{ $purchaseOrders->currentPage()==$i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $purchaseOrders->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $purchaseOrders->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $purchaseOrders->nextPageUrl() }}">&raquo;</a>
                </li>
        </ul>
    </nav>

    {{-- Thông tin trang --}}
    <span class="small mb-0">
        Trang {{ $purchaseOrders->currentPage() }} / {{ $purchaseOrders->lastPage() }}
    </span>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editPurchaseModal" tabindex="-1" aria-labelledby="editPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="editPurchaseContent">
            <!-- Nội dung form sửa sẽ được load ở đây -->
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailPurchaseModal" tabindex="-1" aria-labelledby="detailPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="detailPurchaseContent">
            <!-- Nội dung chi tiết sẽ được load ở đây -->
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="addPurchaseModal" tabindex="-1" aria-labelledby="addPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.inputinvoi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addPurchaseModalLabel">Thêm hóa đơn nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="date" class="form-control" name="order_date" id="order_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select class="form-control" name="supplier_id" id="supplier_id" required>
                                <option value="" disabled selected>Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="number" class="form-control" name="total_amount" id="total_amount" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pet_id" class="form-label">Pet</label>
                            <select class="form-control" name="pet_id" id="pet_id" required>
                                <option value="" disabled selected>Select Pet</option>
                                @foreach($pets as $pet)
                                <option value="{{ $pet->pet_id }}">{{ $pet->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="invoice_file" class="form-label">Link</label>
                        <input type="text" class="form-control" name="invoice_file" id="invoice_file">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sản phẩm này?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- JS xử lý modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Bấm nút sửa
        $('.btn-edit').click(function() {
            var purchase_order_id = $(this).data('id'); // Đặt tên biến rõ ràng
            $.ajax({
                url: '/admin/inputinvoi/edit/' + purchase_order_id,
                method: 'GET',
                success: function(response) {
                    $('#editPurchaseContent').html(response);
                    $('#editPurchaseModal').modal('show');
                },
                error: function() {
                    alert('Không thể tải form chỉnh sửa!');
                }
            });
        });

        // Bấm nút xem chi tiết
        $('.btn-detail').click(function() {
            var purchase_order_id = $(this).data('id'); // Đặt tên biến rõ ràng
            $.ajax({
                url: '/admin/inputinvoi/show/' + purchase_order_id,
                method: 'GET',
                success: function(response) {
                    $('#detailPurchaseContent').html(response);
                    $('#detailPurchaseModal').modal('show');
                },
                error: function() {
                    alert('Không thể tải chi tiết đơn hàng!');
                }
            });
        });
        $('.btn-delete').click(function() {
            const url = $(this).data('url');
            $('#deleteForm').attr('action', url);
            $('#deleteConfirmModal').modal('show');
        });
    });
</script>
<script>
    document.addEventListener('input', function() {
        const quantity = parseFloat(document.getElementById('quantity').value) || 0;
        const price = parseFloat(document.getElementById('price').value) || 0;
        const total = quantity * price;
        document.getElementById('total_amount').value = total.toFixed(2);
    });
</script>


@endsection