@extends('Admin.admin')
@section('title', 'Danh sách Khách Hàng')
@section('main')

<div class="table-container">
    <h2 class="table-title">Danh sách Khách Hàng</h2>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $item)
            <tr class="align-middle text-center">
                <td>{{ $item->customer_id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->address }}</td>
                <td class="d-flex justify-content-center gap-2">
                    <form action="{{ route('admin.customer.destroy', $item->customer_id) }}" method="POST"
                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Xóa">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ========== PHÂN TRANG ========== --}}
<div class="d-flex justify-content-center align-items-center flex-wrap gap-3 py-3">
    {{-- Chọn số bản ghi --}}
    <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center gap-2 mb-0">
        <label for="perPageSelect" class="mb-0 small">Hiển thị:</label>
        <select name="perPage" id="perPageSelect"
                class="form-select form-select-sm"
                style="width:auto"
                onchange="this.form.submit()">
            @foreach([10,20,30,40,50] as $size)
                <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- Phân trang --}}
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm mb-0">
            <li class="page-item {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $customers->previousPageUrl() }}">&laquo;</a>
            </li>
            @for ($i = 1; $i <= $customers->lastPage(); $i++)
                <li class="page-item {{ $customers->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $customers->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $customers->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $customers->nextPageUrl() }}">&raquo;</a>
            </li>
        </ul>
    </nav>

    <span class="small mb-0">
        Trang {{ $customers->currentPage() }} / {{ $customers->lastPage() }}
    </span>
</div>

@endsection
