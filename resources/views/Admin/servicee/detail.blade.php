<div class="modal-header bg-info text-white">
    <h5 class="modal-title" id="detailServiceModalLabel">Chi tiết dịch vụ: {{ $service->ServiceName }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <strong class="text-secondary">Tên dịch vụ:</strong>
        <div class="text-dark">{{ $service->ServiceName }}</div>
    </div>
    <div class="mb-3">
        <strong class="text-secondary">Mô tả:</strong>
        <div class="text-dark">{{ $service->Description }}</div>
    </div>
    <div class="mb-3">
        <strong class="text-secondary">Giá:</strong>
        <div class="text-dark">{{ number_format($service->Price, 0, ',', '.') }} VND</div>
    </div>
    <div class="mb-3">
        <strong class="text-secondary">Thời gian dịch vụ (phút):</strong>
        <div class="text-dark">{{ $service->ServiceDuration }}</div>
    </div>
    <div class="mb-3">
        <strong class="text-secondary">Ngày tạo:</strong>
        <div class="text-dark">{{ \Carbon\Carbon::parse($service->CreatedAt)->format('d/m/Y H:i') }}</div>
    </div>
    <div class="mb-3">
        <strong class="text-secondary">Chỗ trống còn lại:</strong>
        <div class="text-dark">{{ $service->AvailableSlots }}</div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
</div>
