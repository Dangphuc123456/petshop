@extends('Admin.admin')
@section('title')
@section('main')
<div class="table-container">
    <h2 class="table-title">Danh sách đặt phòng</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.booking.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> ADD
        </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr style="text-align: center;">
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Ngày nhận </th>
                <th>Ngày trả</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $bookingItem)
            <tr class="align-middle text-center">
                <td>{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}</td>
                <td>{{ $bookingItem->CustomerName }}</td>
                <td>{{ \Carbon\Carbon::parse($bookingItem->CheckInDate)->format('d/m/Y')  }}</td>
                <td>{{ \Carbon\Carbon::parse($bookingItem->CheckOutDate)->format('d/m/Y')  }}</td>
                <td>{{ $bookingItem->BookingStatus }}</td>
                <td class="d-flex flex-wrap gap-1 justify-content-center">
                    @if($bookingItem->BookingStatus != 'Đã hủy' && $bookingItem->BookingStatus != 'Đã trả phòng')
                    <form action="{{ route('admin.booking.confirm', ['BookingID' => $bookingItem->BookingID]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $bookingItem->BookingStatus == 'Đã xác nhận' ? 'disabled' : '' }}>
                           <i class="fas fa-check-circle" title="Xác nhận"></i>
                        </button>
                    </form>
                    <form action="{{ route('admin.booking.checkout', ['BookingID' => $bookingItem->BookingID]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $bookingItem->BookingStatus == 'Đã trả phòng' ? 'disabled' : '' }}>
                            <i class="fas fa-check-double"title="hoàn thành" ></i>
                        </button>
                    </form>
                    <button type="button"
                        class="btn btn-danger btn-delete"
                        data-url="{{ route('admin.booking.cancel', ['BookingID' => $bookingItem->BookingID]) }}"
                        title="Xóa" style="padding:8px;">
                        <i class="fas fa-times-circle" title="Hủy"></i>
                    </button>
                    @else
                    @if($bookingItem->BookingStatus == 'Đã hủy')
                    <span class="badge bg-danger" style="padding: 14px;">Đã hủy</span>
                    @elseif($bookingItem->BookingStatus == 'Đã trả phòng')
                    <span class="badge bg-success" style="padding: 14px;">Đã trả phòng</span>
                    @endif
                    @endif
                    <a href="{{ route('admin.booking.show', $bookingItem->BookingID) }}" class="btn btn-info btn-sm" style="padding:7px;background-color: rgb(51, 102, 204);color:white"><i class="fas fa-eye"></i></a>
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
            style="width:auto"
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
            <li class="page-item {{ $bookings->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $bookings->previousPageUrl() }}">&laquo;</a>
            </li>

            {{-- Số trang --}}
            @for ($i = 1; $i <= $bookings->lastPage(); $i++)
                <li class="page-item {{ $bookings->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $bookings->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $bookings->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $bookings->nextPageUrl() }}">&raquo;</a>
                </li>
        </ul>
    </nav>

    {{-- Thông tin trang --}}
    <span class="small mb-0">
        Trang {{ $bookings->currentPage() }} / {{ $bookings->lastPage() }}
    </span>
</div>

<!-- Modal hủy -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn hủy phòng đặt này?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hủy Đặt Phòng</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function() {
            const url = $(this).data('url');
            $('#deleteForm').attr('action', url);
            $('#deleteConfirmModal').modal('show');
        });
    });
</script>
@endsection