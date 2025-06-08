@extends('Admin.admin')
@section('title', 'Danh sách Tin Tức')
@section('main')

<div class="table-container">
    <h2 class="table-title">Danh sách Bài Viết</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.new.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> ADD
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr class="align-middle text-center">
                <td class="text-center">{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->author }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')  }}</td>
                <td class="text-center d-flex justify-content-center gap-2">
                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id }}" title="Chỉnh sửa" style="padding:8px;">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-success btn-detail" data-id="{{ $item->id }}" title="Xem chi tiết" style="background-color: rgb(51, 102, 204);color:black; padding:8px;">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button type="button"
                        class="btn btn-danger btn-delete"
                        data-url="{{ route('new.destroy', $item->id) }}"
                        title="Xóa" style="padding:8px;">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ========== PER-PAGE + PAGINATION ========== --}}
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
            <li class="page-item {{ $news->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $news->previousPageUrl() }}">&laquo;</a>
            </li>

            {{-- Số trang --}}
            @for ($i = 1; $i <= $news->lastPage(); $i++)
                <li class="page-item {{ $news->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $news->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $news->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $news->nextPageUrl() }}">&raquo;</a>
                </li>
        </ul>
    </nav>

    {{-- Thông tin trang --}}
    <span class="small mb-0">
        Trang {{ $news->currentPage() }} / {{ $news->lastPage() }}
    </span>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="editNewsContent"></div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailNewsModal" tabindex="-1" aria-labelledby="detailNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="detailNewsContent"></div>
    </div>
</div>
<!-- Modal xác nhận xóa -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        // Hiển thị form chỉnh sửa
        $('.btn-edit').click(function() {
            const id = $(this).data('id');
            $.get("{{ url('admin/new/edit') }}/" + id, function(res) {
                $('#editNewsContent').html(res);
                $('#editNewsModal').modal('show');
            }).fail(function() {
                alert('Không thể tải form chỉnh sửa!');
            });
        });

        // Hiển thị chi tiết tin tức
        $('.btn-detail').click(function() {
            const id = $(this).data('id');
            $.get("{{ url('admin/new/show') }}/" + id, function(res) {
                $('#detailNewsContent').html(res);
                $('#detailNewsModal').modal('show');
            }).fail(function() {
                alert('Không thể tải chi tiết tin tức!');
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