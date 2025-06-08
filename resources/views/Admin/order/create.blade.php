@extends('Admin.admin')
@section('title', 'Tạo đơn hàng tại quầy')
@section('main')
<div class="container">
    <h2>Tạo đơn hàng tại quầy</h2>
    <form method="GET" action="{{ route('admin.order.create') }}" class="mb-3">
        <input type="text" name="search" placeholder="Tìm theo mã pet_id..." class="form-control d-inline w-25">
        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
    </form>

    <form method="POST" action="{{ route('admin.order.store') }}">
        @csrf

        <div class="mb-3">
            <label>Tên khách hàng</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <h4>Danh sách sản phẩm</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Chọn</th>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Loài</th>
                    <th>Giống</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Số lượng mua</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $pet->pet_id }}" class="pet-check"></td>
                        <td>{{ $pet->pet_id }}</td>
                        <td><img src="{{ asset('anh/' . $pet->image_url) }}" width="60" height="70"></td>
                        <td>{{ $pet->species }}</td>
                        <td>{{ $pet->breed }}</td>
                        <td>{{ number_format($pet->price, 0) }}₫</td>
                        <td>{{ $pet->quantity_in_stock }}</td>
                        <td>
                            <input type="number" name="items[{{ $pet->pet_id }}][quantity]" min="1" max="{{ $pet->quantity_in_stock }}" class="form-control" disabled>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Tạo đơn hàng</button>
    </form>
</div>

<script>
    // Chỉ cho phép nhập số lượng khi checkbox được chọn
    document.querySelectorAll('.pet-check').forEach(function(checkbox) {
        checkbox.addEventListener('change', function () {
            const row = this.closest('tr');
            const input = row.querySelector('input[type="number"]');
            input.disabled = !this.checked;
        });
    });
</script>
@endsection
