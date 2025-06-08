@extends('Admin.admin')

@section('title', 'List Pets')

@section('main')
<div class="table-container">
  <h2 class="table-title">Danh sách sản phẩm</h2>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPetModal">
    <i class="fas fa-plus"></i> ADD
  </button>
  <table class="table table-bordered text-center align-middle">
    <thead class="table-light">
      <tr>
        <th>STT</th>
        <th>Mô Tả</th>
        <th>Giá</th>
        <th>Ảnh</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pets as $index => $pet)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $pet->description }}</td>
        <td>{{ number_format($pet->price, 0, ',', '.') }}đ</td>
        <td>
          <img src="{{ asset('anh/' . $pet->image_url) }}" alt="Product image" class="img-thumbnail" style="width: 100px; height: 100px;">
        </td>
        <td>
          <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $pet->pet_id }}" title="Sửa" style="padding:8px;">
              <i class='fas fa-edit'></i>
            </button>
            <button class="btn btn-info btn-sm btn-detail" data-id="{{ $pet->pet_id }}" title="Xem chi tiết" style="padding:8px;background-color: rgb(51, 102, 204)">
              <i class="fa fa-eye"></i>
            </button>
            <button type="button"
              class="btn btn-danger btn-delete"
              data-url="{{ route('pets.destroy', $pet->pet_id) }}"
              title="Xóa" style="padding:8px;">
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Pagination + Per Page -->
<div class="d-flex justify-content-center align-items-center flex-wrap gap-3 py-3">
  {{-- Chọn số bản ghi --}}
  <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center gap-2 mb-0">
    <label for="perPageSelect" class="mb-0 small">Hiển thị:</label>
    <select name="perPage" id="perPageSelect"
      class="form-select form-select-sm"
      style="width: auto;"
      onchange="this.form.submit()">
      @foreach([10,20,30,40,50] as $size)
      <option value="{{ $size }}" {{ request('perPage',10)==$size ? 'selected':'' }}>
        {{ $size }}
      </option>
      @endforeach
    </select>
  </form>

  {{-- Phân trang --}}
  <nav aria-label="Page navigation">
    <ul class="pagination pagination-sm mb-0">
      {{-- Prev --}}
      <li class="page-item {{ $pets->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $pets->previousPageUrl() }}&perPage={{ request('perPage',10) }}" tabindex="-1">
          &laquo;
        </a>
      </li>

      {{-- Số trang --}}
      @for ($i = 1; $i <= $pets->lastPage(); $i++)
        <li class="page-item {{ $pets->currentPage()==$i ? 'active' : '' }}">
          <a class="page-link" href="{{ $pets->url($i) }}&perPage={{ request('perPage',10) }}">
            {{ $i }}
          </a>
        </li>
        @endfor

        {{-- Next --}}
        <li class="page-item {{ $pets->hasMorePages() ? '' : 'disabled' }}">
          <a class="page-link" href="{{ $pets->nextPageUrl() }}&perPage={{ request('perPage',10) }}">
            &raquo;
          </a>
        </li>
    </ul>
  </nav>

  {{-- Thông tin hiện tại --}}
  <span class="small mb-0">
    Trang {{ $pets->currentPage() }} / {{ $pets->lastPage() }}
  </span>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="editPetModal" tabindex="-1" aria-labelledby="editPetModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="editPetContent">
      <!-- Nội dung ajax -->
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailPetModal" tabindex="-1" aria-labelledby="detailPetModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detailPetContent">
      <!-- Nội dung ajax -->
    </div>
  </div>
</div>
<!-- Modal hủy -->
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
<!-- Modal Add Pet -->
<div class="modal fade" id="addPetModal" tabindex="-1" aria-labelledby="addPetModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.pets.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="addPetModalLabel">Thêm thú cưng mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">

            <div class="col-md-6">
              <label for="species" class="form-label">Loài</label>
              <input type="text" name="species" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="breed" class="form-label">Giống</label>
              <input type="text" name="breed" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="gender" class="form-label">Giới tính</label>
              <select name="gender" class="form-select" required>
                <option value="Đực">Đực</option>
                <option value="Cái">Cái</option>
                <option value="Khác">Khác</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="age" class="form-label">Tuổi</label>
              <input type="number" name="age" class="form-control" min="0">
            </div>
            <div class="col-md-6">
              <label for="price" class="form-label">Giá</label>
              <input type="number" name="price" class="form-control" min="0" required>
            </div>
            <div class="col-md-6">
              <label for="image_url" class="form-label">Ảnh</label>
              <input type="file" class="form-control" name="image_url" id="image_url">
            </div>
            <div class="col-md-6">
              <label for="category_id" class="form-label">Loại sản phẩm</label>
              <select name="category_id" class="form-select" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($category as $category)
                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <label for="description" class="form-label">Mô tả</label>
              <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="col-12">
              <label for="status" class="form-label">Trạng thái</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="status" id="status" checked>
                <label class="form-check-label" for="status">
                  Đang bán
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer mt-3">
          <button type="submit" class="btn btn-primary">Thêm</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btn-edit').click(function() {
      const id = $(this).data('id');

      // Lấy page và perPage từ URL hiện tại
      const urlParams = new URLSearchParams(window.location.search);
      const page = urlParams.get('page') || 1;
      const perPage = urlParams.get('perPage') || 10;

      // Gọi đến route edit (trả về view form sửa)
      $.get(`/admin/pets/edit/${id}?page=${page}&perPage=${perPage}`, function(response) {
        $('#editPetContent').html(response);
        $('#editPetModal').modal('show');
      }).fail(function() {
        alert('Không tải được form sửa!');
      });
    });


    $('.btn-detail').click(function() {
      const id = $(this).data('id');
      $.get(`/admin/pets/show/${id}`, function(response) {
        $('#detailPetContent').html(response);
        $('#detailPetModal').modal('show');
      }).fail(function() {
        alert('Không tải được thông tin chi tiết!');
      });
    });
    $('.btn-delete').click(function() {
      const url = $(this).data('url');
      $('#deleteForm').attr('action', url);
      $('#deleteConfirmModal').modal('show');
    });
  });
</script>
@endsection