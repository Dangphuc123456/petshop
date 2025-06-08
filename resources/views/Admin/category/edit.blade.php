<div class="modal-header bg-warning">
    <h5 class="modal-title">Chỉnh sửa danh mục {{ $category->category_id }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form action="{{ route('admin.category.update', $category->category_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3 row">
                    <label for="category_id" class="col-sm-4 col-form-label">Mã danh mục</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm bg-light" id="category_id" name="category_id" value="{{ $category->category_id }}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="category_name" class="col-sm-4 col-form-label">Tên danh mục</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-save me-1"></i> Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
