@extends('Admin.admin')
@section('title', 'Danh sách lịch hẹn')
@section('main')
<div class="table-container">
    <h2 class="table-title">Danh sách lịch hẹn</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentModal">
        <i class="fas fa-plus"></i> ADD
    </button>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Ngày hẹn</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr class="align-middle text-center">
                {{-- STT liên tục qua các trang --}}
                <td>
                    {{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}
                </td>
                <td>{{ $appointment->CustomerName }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->AppointmentDate)->format('d/m/Y') }}</td>
                <td>{{ $appointment->Status }}</td>
                <td class="d-flex flex-wrap gap-1 justify-content-center">
                    @if(!in_array($appointment->Status, ['Đã hủy', 'Hoàn thành']))
                    <form action="{{ route('admin.appointments.confirm', ['AppointmentID' => $appointment->AppointmentID]) }}"
                        method="POST">
                        @csrf
                        <button class="btn btn-success"
                            {{ $appointment->Status == 'Đã xác nhận' ? 'disabled' : '' }}>
                           <i class="fas fa-check-circle" title="Xác nhận"></i>
                        </button>
                    </form>
                    <form action="{{ route('admin.appointments.complete', ['AppointmentID' => $appointment->AppointmentID]) }}"
                        method="POST">
                        @csrf
                        <button class="btn btn-success"
                            {{ $appointment->Status == 'Hoàn thành' ? 'disabled' : '' }}>
                           <i class="fas fa-check-double" title="Hoàn thành"></i>
                        </button>
                    </form>
                    <button type="button"
                        class="btn btn-danger btn-delete"
                        data-url="{{ route('admin.appointments.cancel', ['AppointmentID' => $appointment->AppointmentID]) }}"
                        title="Xóa" style="padding:8px;">
                        <i class="fas fa-times-circle" title="Hủy"></i>
                    </button>
                    @else
                    @if($appointment->Status == 'Đã hủy')
                    <span class="badge bg-danger" style="padding: 14px;">Đã hủy</span>
                    @else
                    <span class="badge bg-success" style="padding: 14px;">Hoàn thành</span>
                    @endif
                    @endif
                    <a href="{{ route('admin.appointments.show', $appointment->AppointmentID) }}" class="btn btn-info btn-sm"style="padding:7px;background-color: rgb(51, 102, 204);color:white">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Per-page selector + Pagination --}}
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
            <li class="page-item {{ $appointments->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $appointments->previousPageUrl() }}">&laquo;</a>
            </li>

            {{-- Số trang --}}
            @for ($i = 1; $i <= $appointments->lastPage(); $i++)
                <li class="page-item {{ $appointments->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $appointments->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $appointments->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $appointments->nextPageUrl() }}">&raquo;</a>
                </li>
        </ul>
    </nav>

    {{-- Thông tin trang --}}
    <span class="small mb-0">
        Trang {{ $appointments->currentPage() }} / {{ $appointments->lastPage() }}
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
                    <h5 class="modal-title">Xác nhận hủy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn hủy lịch hẹn này?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hủy lịch hẹn</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal đặt lịch hẹn -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title fw-bold text-dark" id="appointmentModalLabel">
                    <i class="bi bi-calendar-check-fill"></i> Thông Tin Đặt Lịch
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.appointments.store') }}" method="POST" id="appointmentForm">
                    @csrf
                    <div class="mb-3">
                        <label for="ServiceID" class="form-label fw-bold">Chọn dịch vụ <span class="text-danger">*</span></label>
                        <select id="ServiceID" name="ServiceID" class="form-select" required>
                            <option value="">-- Chọn dịch vụ --</option>
                            @foreach($service as $item)
                            <option value="{{ $item->ServiceID }}">
                                {{ $item->ServiceName }} - {{ number_format($item->Price, 0, ',', '.') }}đ
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="LocationName" class="form-label fw-bold">Chọn địa điểm <span class="text-danger">*</span></label>
                        <select id="LocationName" name="LocationName" class="form-select" required>
                            <option value="">-- Chọn địa điểm --</option>
                            <option value="Số 168 Thượng Đình - Thanh Xuân - Hà Nội">Số 168 Thượng Đình - Thanh Xuân - Hà Nội</option>
                            <option value="294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh">294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="CustomerName" class="form-label fw-bold">Tên khách hàng <span class="text-danger">*</span></label>
                        <input type="text" id="CustomerName" name="CustomerName" class="form-control" placeholder="Nhập tên khách hàng" required>
                    </div>

                    <div class="mb-3">
                        <label for="CustomerContact" class="form-label fw-bold">Thông tin liên lạc <span class="text-danger">*</span></label>
                        <input type="text" id="CustomerContact" name="CustomerContact" class="form-control" placeholder="SĐT hoặc Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="AppointmentDate" class="form-label fw-bold">Ngày / Giờ hẹn <span class="text-danger">*</span></label>
                        <input type="datetime-local" id="AppointmentDate" name="AppointmentDate" class="form-control" required>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" form="appointmentForm">
                    <i class="bi bi-check-circle-fill"></i> Đặt lịch
                </button>
            </div>
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