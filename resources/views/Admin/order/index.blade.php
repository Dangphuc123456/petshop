@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')
<div class="table-container">
  <h2 class="table-title">Danh sách đơn hàng bán</h2>
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.order.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> ADD
    </a>
  </div>
  <table class="table table-bordered">
    <thead>
      <tr style="text-align: center;">
        <th>STT</th>
        <th>Tên khách hàng</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr class="align-middle text-center">
        <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
        <td>{{ $order->customer_name }}</td>
        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y')  }}</td>
        <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
        <td>{{ $order->status }}</td>
        <td class="d-flex flex-wrap gap-1 justify-content-center">
          @if($order->status != 'Đã hủy' && $order->status != 'Hoàn thành')

          {{-- Nút Xác nhận --}}
          <form action="{{ route('admin.order.confirm', ['order_id' => $order->order_id]) }}" method="POST" >
            @csrf
            <button type="submit" class="btn btn-success " {{ $order->status == 'Đã xác nhận' || $order->status == 'Đang giao hàng' || $order->status == 'Hoàn thành' ? 'disabled' : '' }}>
              <i class="fas fa-check-circle"></i>
            </button>
          </form>

          {{-- Nút Đang giao --}}
          <form action="{{ route('admin.order.delivery', ['order_id' => $order->order_id]) }}" method="POST" >
            @csrf
            <button type="submit" class="btn btn-warning " {{ $order->status == 'Đang giao hàng' || $order->status == 'Hoàn thành' ? 'disabled' : '' }}>
             <i class="fas fa-truck"></i>
            </button>
          </form>

          {{-- Nút Hoàn thành --}}
          <form action="{{ route('admin.order.delivered', ['order_id' => $order->order_id]) }}" method="POST" >
            @csrf
            <button type="submit" class="btn btn-success " {{ $order->status == 'Hoàn thành' ? 'disabled' : '' }}>
             <i class="fas fa-check-double"></i>
            </button>
          </form>

          {{-- Nút Hủy đơn --}}
          <form action="{{ route('admin.order.cancel', ['order_id' => $order->order_id]) }}" method="POST" >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger " onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
              <i class="fas fa-times-circle"></i>
            </button>
          </form>
          @else
          @if($order->status == 'Đã hủy')
          <span class="badge bg-danger" style="padding: 14px;">Đã hủy</span>
          @elseif($order->status == 'Hoàn thành')
          <span class="badge bg-success" style="padding: 14px;">Hoàn thành</span>
          @endif
          @endif
          <a href="{{ route('admin.order.show', ['order_id' => $order->order_id]) }}" class="btn btn-success" style="background-color: rgb(51, 102, 204); color:black;">
            <i class="fas fa-eye"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="d-flex justify-content-center align-items-center flex-wrap gap-3 py-3">
  {{-- Chọn số bản ghi --}}
  <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center gap-2 mb-0">
    <label for="perPageSelect" class="mb-0 small">Hiển thị:</label>
    <select name="perPage" id="perPageSelect"
      class="form-select form-select-sm"
      style="width: auto;"
      onchange="this.form.submit()">
      @foreach([10,20,30,40,50] as $size)
      <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
        {{ $size }}
      </option>
      @endforeach
    </select>
  </form>

  {{-- Thanh phân trang --}}
  <nav aria-label="Page navigation">
    <ul class="pagination pagination-sm mb-0">
      {{-- Prev --}}
      <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link"
          href="{{ $orders->previousPageUrl() }}"
          tabindex="-1">&laquo;</a>
      </li>

      {{-- Số trang --}}
      @for ($i = 1; $i <= $orders->lastPage(); $i++)
        <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
          <a class="page-link"
            href="{{ $orders->url($i) }}">
            {{ $i }}
          </a>
        </li>
        @endfor

        {{-- Next --}}
        <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
          <a class="page-link"
            href="{{ $orders->nextPageUrl() }}">&raquo;</a>
        </li>
    </ul>
  </nav>

  {{-- Trang hiện tại --}}
  <span class="small mb-0">
    Trang {{ $orders->currentPage() }} / {{ $orders->lastPage() }}
  </span>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection