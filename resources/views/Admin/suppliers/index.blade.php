@extends('Admin.admin')
@section('title', 'List Supplier')
@section('main')
<div class="table-container">
  <h2 class="table-title">Danh sách nhà cung cấp</h2>
   <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
        <i class="fas fa-plus"></i> ADD
    </button>
  <table class="table table-bordered">
    <thead>
      <tr class="text-center">
        <th>STT</th>
        <th>Name</th>
        <th>Contact Person</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($suppliers as $supplier)
      <tr class="align-middle text-center">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $supplier->name }}</td>
        <td>{{ $supplier->contact_person }}</td>
        <td>{{ $supplier->address }}</td>
        <td>{{ $supplier->phone }}</td>
        <td>{{ $supplier->email }}</td>
        <td class="d-flex gap-2 justify-content-center">
          <button class="btn btn-warning btn-edit" data-id="{{ $supplier->supplier_id }}" style="padding:8px;">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-success btn-detail" data-id="{{ $supplier->supplier_id }}" style="background-color: rgb(51, 102, 204); color:black; padding:8px;">
            <i class="fa fa-eye"></i>
          </button>
          <button type="button"
            class="btn btn-danger btn-delete"
            data-url="{{ route('suppliers.destroy', $supplier->supplier_id) }}"
            title="Xóa" style="padding:8px;">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{-- PER-PAGE + PAGINATION --}}
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
      <li class="page-item {{ $suppliers->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $suppliers->previousPageUrl() }}">&laquo;</a>
      </li>

      {{-- Số trang --}}
      @for ($i = 1; $i <= $suppliers->lastPage(); $i++)
        <li class="page-item {{ $suppliers->currentPage() == $i ? 'active' : '' }}">
          <a class="page-link" href="{{ $suppliers->url($i) }}">
            {{ $i }}
          </a>
        </li>
        @endfor

        {{-- Next --}}
        <li class="page-item {{ $suppliers->hasMorePages() ? '' : 'disabled' }}">
          <a class="page-link" href="{{ $suppliers->nextPageUrl() }}">&raquo;</a>
        </li>
    </ul>
  </nav>

  {{-- Thông tin trang --}}
  <span class="small mb-0">
    Trang {{ $suppliers->currentPage() }} / {{ $suppliers->lastPage() }}
  </span>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="editSupplierContent"></div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailSupplierModal" tabindex="-1" aria-labelledby="detailSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detailSupplierContent"></div>
  </div>
</div>
<!-- Modal Xác nhận Xóa -->
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
          Bạn có chắc chắn muốn xóa nhà cung cấp này?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Xóa</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        </div>
      </form>
    </div>
  </div>
</div>
 <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addSupplierModalLabel">Thêm Nhà Cung Cấp Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.suppliers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Các trường form -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên nhà cung cấp</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Người liên hệ</label>
                            <input type="text" class="form-control" name="contact_person" id="contact_person" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="number" class="form-control" name="phone" id="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Thêm nhà cung cấp</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btn-edit').click(function() {
      var supplierId = $(this).data('id');
      $.get('/admin/suppliers/edit/' + supplierId, function(html) {
        $('#editSupplierContent').html(html);
        $('#editSupplierModal').modal('show');
      }).fail(function() {
        alert('Không tải được form chỉnh sửa!');
      });
    });

    $('.btn-detail').click(function() {
      var supplierId = $(this).data('id');
      $.get('/admin/suppliers/show/' + supplierId, function(html) {
        $('#detailSupplierContent').html(html);
        $('#detailSupplierModal').modal('show');
      }).fail(function() {
        alert('Không tải được thông tin chi tiết!');
      });
    });
    // Xác nhận xóa bằng modal
    $('.btn-delete').click(function() {
      const url = $(this).data('url');
      $('#deleteForm').attr('action', url);
      $('#deleteConfirmModal').modal('show');
    });

  });
</script>
@endsection