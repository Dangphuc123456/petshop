@extends('Admin.admin')
@section('title', 'List Categories')
@section('main')

<div class="table-container">
    <h2 class="table-title">Danh sách Danh Mục</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> ADD
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr style="text-align: center;">
                <th>STT</th>
                <th>Tên Danh Mục</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $category)
            <tr class="align-middle text-center">
                <td>{{ $category->category_id }}</td>
                <td>{{ $category->category_name }}</td>
                <td style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                    <button class="btn btn-warning btn-edit" data-id="{{ $category->category_id }}" style="background-color: #FFCC33; border: none; outline: none; padding:8px;">
                        <i class='fas fa-edit'></i>
                    </button>
                    <button class="btn btn-success btn-detail" data-id="{{ $category->category_id }}" style="background-color: rgb(51, 102, 204);color:black; border: none; outline: none; padding:8px;">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button type="button"
                        class="btn btn-danger btn-delete"
                        data-url="{{ route('category.destroy', $category->category_id) }}"
                        title="Xóa" style="padding:8px;">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="editCategoryContent">
            <!-- Nội dung form sửa sẽ được load ở đây -->
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailCategoryModal" tabindex="-1" aria-labelledby="detailCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="detailCategoryContent">
            <!-- Nội dung chi tiết sẽ được load ở đây -->
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
                    Bạn có chắc chắn muốn xóa loại sản phẩm này?
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
    $(document).ready(function() {
        $('.btn-edit').click(function() {
            var categoryId = $(this).data('id');
            $.ajax({
                url: '/admin/category/edit/' + categoryId,
                method: 'GET',
                success: function(response) {
                    $('#editCategoryContent').html(response);
                    $('#editCategoryModal').modal('show');
                },
                error: function() {
                    alert('Không thể tải form chỉnh sửa!');
                }
            });
        });

        $('.btn-detail').click(function() {
            var categoryId = $(this).data('id');
            $.ajax({
                url: '/admin/category/show/' + categoryId,
                method: 'GET',
                success: function(response) {
                    $('#detailCategoryContent').html(response);
                    $('#detailCategoryModal').modal('show');
                },
                error: function() {
                    alert('Không thể tải chi tiết danh mục!');
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

@endsection