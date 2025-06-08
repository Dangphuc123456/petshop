<div class="modal-header bg-warning text-white">
    <h5 class="modal-title" id="editServiceModalLabel">Chỉnh sửa dịch vụ</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
</div>

<form action="{{ route('admin.servicee.update', $service->ServiceID) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body px-4">
        <div class="mb-3">
            <label for="ServiceName" class="form-label fw-bold">
                <i class="bi bi-card-text me-1"></i> Tên dịch vụ
            </label>
            <input type="text" class="form-control" id="ServiceName" name="ServiceName" value="{{ old('ServiceName', $service->ServiceName) }}" required>
        </div>

        <div class="mb-3">
            <label for="Description" class="form-label fw-bold">
                <i class="bi bi-chat-text me-1"></i> Mô tả
            </label>
            <textarea class="form-control" id="Description" name="Description" rows="3" placeholder="Nhập mô tả chi tiết...">{{ old('Description', $service->Description) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Price" class="form-label fw-bold">
                    <i class="bi bi-currency-dollar me-1"></i> Giá (VNĐ)
                </label>
                <input type="number" class="form-control" id="Price" name="Price" min="0" step="1000" value="{{ old('Price', $service->Price) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="ServiceDuration" class="form-label fw-bold">
                    <i class="bi bi-clock me-1"></i> Thời gian (phút)
                </label>
                <input type="number" class="form-control" id="ServiceDuration" name="ServiceDuration" min="0" value="{{ old('ServiceDuration', $service->ServiceDuration) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="CreatedAt" class="form-label fw-bold">
                    <i class="bi bi-calendar-check me-1"></i> Ngày tạo
                </label>
                <input type="datetime-local" class="form-control" id="CreatedAt" name="CreatedAt" value="{{ old('CreatedAt', \Carbon\Carbon::parse($service->CreatedAt)->format('Y-m-d\TH:i')) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="AvailableSlots" class="form-label fw-bold">
                    <i class="bi bi-people me-1"></i> Chỗ trống còn lại
                </label>
                <input type="number" class="form-control" id="AvailableSlots" name="AvailableSlots" min="0" value="{{ old('AvailableSlots', $service->AvailableSlots) }}">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-save me-1"></i> Cập nhật
            </button>
        </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Đóng
        </button>
    </div>
</form>