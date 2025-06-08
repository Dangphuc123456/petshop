<div class="modal-header bg-primary text-white">
  <h5 class="modal-title">📋 Chi tiết nhà cung cấp</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <div class="card border-0 shadow-sm p-4 bg-light rounded">
    <h5 class="mb-4 fw-bold text-primary">Thông tin nhà cung cấp</h5>

    <div class="mb-3 row">
      <label class="col-sm-3 fw-bold text-dark">Tên nhà cung cấp:</label>
      <div class="col-sm-9">
        <span class="text-muted">{{ $supplier->name }}</span>
      </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-3 fw-bold text-dark">Người liên hệ:</label>
      <div class="col-sm-9">
        <span class="text-muted">{{ $supplier->contact_person }}</span>
      </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-3 fw-bold text-dark">Địa chỉ:</label>
      <div class="col-sm-9">
        <span class="text-muted">{{ $supplier->address }}</span>
      </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-3 fw-bold text-dark">Số điện thoại:</label>
      <div class="col-sm-9">
        <span class="text-muted">{{ $supplier->phone }}</span>
      </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-3 fw-bold text-dark">Email:</label>
      <div class="col-sm-9">
        <span class="text-muted">{{ $supplier->email }}</span>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
</div>