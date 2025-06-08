<div class="modal-header bg-warning text-white">
    <h5 class="modal-title">Chỉnh sửa nhà cung cấp {{ $supplier->supplier_id }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.suppliers.update', $supplier->supplier_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $supplier->name }}" required>
        </div>

        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person:</label>
            <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{ $supplier->contact_person }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ $supplier->address }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ $supplier->phone }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $supplier->email }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Update Supplier</button>
        </div>
    </form>
</div>
