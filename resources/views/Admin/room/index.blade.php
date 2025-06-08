@extends('Admin.admin')
@section('title', 'Danh sách phòng')
@section('main')
<div class="table-container">
  <h2 class="table-title">Danh sách phòng</h2>

  {{-- Nút ADD --}}
  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRoomModal">
    Thêm phòng
  </button>

  {{-- Bảng Room --}}
  <table class="table table-bordered">
    <thead>
      <tr class="text-center">
        <th>STT</th>
        <th>Gía/ngày</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rooms as $room)
      <tr class="text-center align-middle">
        {{-- STT liên tục qua các trang --}}
        <td>
          {{ ($rooms->currentPage() - 1) * $rooms->perPage() + $loop->iteration }}
        </td>
        <td>{{ number_format($room->PricePerNight, 0, ',', '.') }}đ</td>
        <td>{{ $room->Status }}</td>
        <td>
          <div class="d-flex gap-2 justify-content-center">
            {{-- Available --}}
            <form action="{{ route('admin.room.available', ['RoomID' => $room->RoomID]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-success" style="padding:8px;">
                <i class="fas fa-check-circle " title="Sẵn sàng"></i>
              </button>
            </form>
            {{-- Occupied --}}
            <form action="{{ route('admin.room.occupied', ['RoomID' => $room->RoomID]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-warning" style="padding:8px;">
                <i class="fas fa-door-closed text-danger" title="Đã có người sử dụng"></i>
              </button>
            </form>
            {{-- Maintenance --}}
            <form action="{{ route('admin.room.maintenance', ['RoomID' => $room->RoomID]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-secondary" style="padding:8px;">
                <i class="fas fa-wrench text-warning" title="Đang bảo trì"></i>
              </button>
            </form>
            {{-- Detail --}}
            <a href="{{ route('admin.room.detail', $room->RoomID) }}" class="btn btn-sm btn-info text-white" style="padding:8px;background-color: rgb(51, 102, 204)">
              <i class="fa fa-eye"></i>
            </a>
            {{-- Delete --}}
            <button type="button"
              class="btn btn-danger btn-delete"
              data-url="{{ route('room.destroy', $room->RoomID) }}}"
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

{{-- Per-page + Pagination --}}
<div class="d-flex justify-content-center align-items-center flex-wrap gap-3 py-3">
  {{-- Selector số bản ghi --}}
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
      <li class="page-item {{ $rooms->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $rooms->previousPageUrl() }}">&laquo;</a>
      </li>

      {{-- Số trang --}}
      @for ($i = 1; $i <= $rooms->lastPage(); $i++)
        <li class="page-item {{ $rooms->currentPage() == $i ? 'active' : '' }}">
          <a class="page-link" href="{{ $rooms->url($i) }}">
            {{ $i }}
          </a>
        </li>
        @endfor

        {{-- Next --}}
        <li class="page-item {{ $rooms->hasMorePages() ? '' : 'disabled' }}">
          <a class="page-link" href="{{ $rooms->nextPageUrl() }}">&raquo;</a>
        </li>
    </ul>
  </nav>

  {{-- Thông tin trang --}}
  <span class="small mb-0">
    Trang {{ $rooms->currentPage() }} / {{ $rooms->lastPage() }}
  </span>
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
          Bạn có chắc chắn muốn xóa tin tức này?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Xóa</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.room.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRoomModalLabel">Thêm phòng mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="price_per_night" class="form-label">Giá mỗi đêm</label>
            <input type="number" name="price_per_night" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" class="form-select" required>
               <option value="Available">Available</option>
              <option value="Occupied">Occupied</option>
              <option value="Maintenance">Maintenance</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="region" class="form-label">Miền</label>
            <select name="region" class="form-select" required>
              <option value="Bac">Miền Bắc</option>
              <option value="Nam">Miền Nam</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Lưu</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        </div>
      </div>
    </form>
  </div>
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.btn-delete').click(function() {
        const url = $(this).data('url');
        $('#deleteForm').attr('action', url);
        $('#deleteConfirmModal').modal('show');
      });
    });
  </script>
  @endsection