@extends('Admin.admin')
@section('title', 'List Service')
@section('main')
<div class="table-container">
    <h2 class="table-title">Danh sách dịch vụ</h2>
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="fas fa-plus"></i> ADD
        </button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>ServiceName</th>
                <th>Mô tả</th>
                <th>Gía</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $sv)
            <tr class="align-middle text-center">
                <td>{{ $sv->ServiceID }}</td>
                <td>{{ $sv->ServiceName }}</td>
                <td>{{ $sv->Description }}</td>
                <td>{{ number_format($sv->Price, 0, ',', '.') }}đ</td>
                <td class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-warning btn-edit" data-id="{{ $sv->ServiceID }}" style="padding:8px;">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-detail" data-id="{{ $sv->ServiceID  }}" style="padding:8px;background-color: rgb(51, 102, 204)">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button type="button"
                        class="btn btn-danger btn-delete"
                        data-url="{{ route('servicee.destroy', ['service_id' => $sv->ServiceID]) }}"
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
            <li class="page-item {{ $services->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $services->previousPageUrl() }}">&laquo;</a>
            </li>

            {{-- Số trang --}}
            @for ($i = 1; $i <= $services->lastPage(); $i++)
                <li class="page-item {{ $services->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $services->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $services->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $services->nextPageUrl() }}">&raquo;</a>
                </li>
        </ul>
    </nav>

    {{-- Thông tin trang --}}
    <span class="small mb-0">
        Trang {{ $services->currentPage() }} / {{ $services->lastPage() }}
    </span>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="editServiceContent"></div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailServiceModal" tabindex="-1" aria-labelledby="detailServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="detailServiceContent"></div>
    </div>
</div>
<!-- Modal xóa -->
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
                    Bạn có chắc chắn muốn xóa dịch này?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add Service -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.servicee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="ServiceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control" name="ServiceName" id="ServiceName" required>
                    </div>

                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="Description" id="Description">
                    </div>

                    <div class="mb-3">
                        <label for="Price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="Price" id="Price" required>
                    </div>

                    <div class="mb-3">
                        <label for="ServiceDuration" class="form-label">Service Duration (minutes)</label>
                        <input type="number" class="form-control" name="ServiceDuration" id="ServiceDuration">
                    </div>

                    <div class="mb-3">
                        <label for="AvailableSlots" class="form-label">Available Slots</label>
                        <input type="number" class="form-control" name="AvailableSlots" id="AvailableSlots">
                    </div>

                    {{-- Nếu sau này bạn xử lý thêm ảnh --}}
                    <div class="mb-3">
                        <label for="image_sv" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image_sv" id="image_sv">
                    </div>

                    {{-- Nếu có trạng thái (status) checkbox --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1">
                            <label class="form-check-label" for="status">Available</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-detail').click(function() {
            var serviceId = $(this).data('id');
            $.get("{{ url('/admin/servicee/show') }}/" + serviceId, function(html) {
                $('#detailServiceContent').html(html);
                $('#detailServiceModal').modal('show');
            }).fail(function() {
                alert('Không tải được thông tin chi tiết!');
            });
        });
        $('.btn-edit').click(function() {
            var serviceId = $(this).data('id');
            $.get('/admin/servicee/edit/' + serviceId, function(html) {
                $('#editServiceContent').html(html);
                $('#editServiceModal').modal('show');
            }).fail(function() {
                alert('Không tải được form chỉnh sửa!');
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