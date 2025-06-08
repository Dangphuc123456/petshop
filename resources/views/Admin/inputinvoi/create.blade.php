@extends('Admin.admin')
@section('title', 'Add New Purchase Order')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="text-center mb-0">Add New Purchase Order</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.inputinvoi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="date" class="form-control" name="order_date" id="order_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select class="form-control" name="supplier_id" id="supplier_id" required>
                                <option value="" disabled selected>Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="number" class="form-control" name="total_amount" id="total_amount" required>
                        </div>

                        <!-- Thêm ô Link ở đây -->
                        <div class="mb-3">
                            <label for="invoice_file" class="form-label">Link</label>
                            <input type="text" class="form-control" name="invoice_file" id="invoice_file">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pet_id" class="form-label">Pet</label>
                            <select class="form-control" name="pet_id" id="pet_id" required>
                                <option value="" disabled selected>Select Pet</option>
                                @foreach($pets as $pet)
                                <option value="{{ $pet->pet_id }}">{{ $pet->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Add </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('input', function() {
        const quantity = parseFloat(document.getElementById('quantity').value) || 0;
        const price = parseFloat(document.getElementById('price').value) || 0;
        const total = quantity * price;
        document.getElementById('total_amount').value = total.toFixed(2);
    });
</script>