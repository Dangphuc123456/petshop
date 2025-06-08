<div class="modal-header bg-primary text-white">
    <h5 class="modal-title"> 📋Chi tiết sản phẩm</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row justify-content-center">
        <!-- Cột trái -->
        <div class="row">
            <!-- Bên trái: Thông tin -->
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Loại:</span> <span>{{ $pet->species }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Giống:</span> <span>{{ $pet->breed }}</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Tuổi:</span> <span>{{ $pet->age }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Giá:</span> <span class="text-danger fw-bold">{{ number_format($pet->price, 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Kho:</span> <span>{{ $pet->quantity_in_stock }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Đã bán:</span> <span>{{ $pet->quantity_sold }}</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Danh mục:</span> <span>{{ $pet->category_id }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Trạng thái:</span>
                        <span>
                            @if($pet->status == 'on') Có sẵn
                            @elseif($pet->status == 'unavailable') Không có sẵn
                            @else Đang chờ
                            @endif
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <span class="fw-bold me-1">Giới tính:</span>
                        <span>
                            @if($pet->gender == 'male') Đực
                            @elseif($pet->gender == 'female') Cái
                            @else Không xác định
                            @endif
                        </span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <span class="fw-bold me-1">Mô tả:</span>
                        <p class="mb-0">{{ $pet->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Bên phải: Ảnh -->
            <div class="col-md-4 text-center">
                <label class="form-label fw-bold">Ảnh sản phẩm</label>
                <div class="border rounded p-2 bg-light">
                    <img style="width: 100%; max-width: 250px; height: auto;" class="img-thumbnail" src="{{ asset('anh/' . $pet->image_url) }}" alt="Product image">
                </div>
            </div>
        </div>
    </div>
</div>