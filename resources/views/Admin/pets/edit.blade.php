<div class="modal-header bg-warning text-white">
    <h5 class="modal-title">Chỉnh sửa sản phẩm {{ $pet->pet_id }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form action="{{ route('admin.pets.update', $pet->pet_id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="perPage" value="{{ request('perPage') }}">
        <input type="hidden" name="page" value="{{ request('page') }}">

        <div class="row justify-content-center">
            <!-- Form bên trái -->
            <div class="col-md-8">
                <!-- Hàng 1 -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="species" class="form-label">Loại</label>
                        <input type="text" name="species" id="species" class="form-control form-control-sm" value="{{ $pet->species }}">
                    </div>
                    <div class="col-md-4">
                        <label for="breed" class="form-label">Giống</label>
                        <input type="text" name="breed" id="breed" class="form-control form-control-sm" value="{{ $pet->breed }}">
                    </div>
                    <div class="col-md-4">
                        <label for="age" class="form-label">Tuổi</label>
                        <input type="number" name="age" id="age" class="form-control form-control-sm" value="{{ $pet->age }}">
                    </div>
                </div>

                <!-- Hàng 2 -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" name="price" id="price" class="form-control form-control-sm" value="{{ $pet->price }}" step="0.01">
                    </div>
                    <div class="col-md-4">
                        <label for="quantity_in_stock" class="form-label">Số lượng trong kho</label>
                        <input type="number" name="quantity_in_stock" id="quantity_in_stock" class="form-control form-control-sm" value="{{ $pet->quantity_in_stock }}">
                    </div>
                    <div class="col-md-4">
                        <label for="quantity_sold" class="form-label">Số lượng đã bán</label>
                        <input type="number" name="quantity_sold" id="quantity_sold" class="form-control form-control-sm" value="{{ $pet->quantity_sold }}">
                    </div>
                </div>

                <!-- Hàng 3 -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <input type="number" name="category_id" id="category_id" class="form-control form-control-sm" value="{{ $pet->category_id }}">
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" id="status" class="form-select form-select-sm">
                            <option value="available" {{ $pet->status == 'available' ? 'selected' : '' }}>Có sẵn</option>
                            <option value="unavailable" {{ $pet->status == 'unavailable' ? 'selected' : '' }}>Không có sẵn</option>
                            <option value="pending" {{ $pet->status == 'pending' ? 'selected' : '' }}>Đang chờ</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Giới tính</label>
                        <select name="gender" id="gender" class="form-select form-select-sm">
                            <option value="male" {{ $pet->gender == 'male' ? 'selected' : '' }}>Đực</option>
                            <option value="female" {{ $pet->gender == 'female' ? 'selected' : '' }}>Cái</option>
                            <option value="unknown" {{ $pet->gender == 'unknown' ? 'selected' : '' }}>Không xác định</option>
                        </select>
                    </div>
                </div>

                <!-- Mô tả -->
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea name="description" id="description" class="form-control form-control-sm" rows="3">{{ $pet->description }}</textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save me-1"></i> Cập nhật
                    </button>
                </div>
            </div>

            <!-- Cột bên phải: ảnh -->
            <div class="col-md-4 text-center">
                <label for="image_url" class="form-label">Chọn ảnh</label>
                <input type="file" name="image_url" id="image_url" class="form-control form-control-sm mb-3">

                <label class="form-label">Xem trước</label><br>
                <img style="width: 100%; max-width: 250px; height: auto;" class="img-thumbnail" src="{{ asset('anh/' . $pet->image_url) }}" alt="Product image">
            </div>
        </div>
    </form>
</div>