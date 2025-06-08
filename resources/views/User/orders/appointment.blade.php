<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>
    @include('User.component.header')
    <div class="container my-4">
        <h3 class="mb-4 mt-4" style="margin-left: 24px;">📅Lịch Hẹn Đặt Phòng vs Dịch vụ vụ</h3>
        <ul class="nav nav-tabs" id="bookingAppointmentTabs" role="tablist" style="cursor:pointer;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="booking-tab" data-bs-toggle="tab" data-bs-target="#booking" type="button" role="tab" aria-controls="booking" aria-selected="true">
                    Đặt Phòng
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="appointment-tab" data-bs-toggle="tab" data-bs-target="#appointment" type="button" role="tab" aria-controls="appointment" aria-selected="false">
                    Lịch Hẹn
                </button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="bookingAppointmentTabsContent">
            <!-- Tab Đặt Phòng -->
            <div class="tab-pane fade show active" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($booking->isEmpty())
                <div class="alert alert-info" style="text-align: center;">Bạn chưa có lịch sử đặt phòng nào.</div>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã Phòng</th>
                            <th>Ngày Nhận Phòng</th>
                            <th>Ngày Trả Phòng</th>
                            <th>Tổng Giá (VNĐ)</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($booking as $b)
                        <tr>
                            <td>Ph{{ $b->RoomID }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->CheckInDate)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->CheckOutDate)->format('d/m/Y') }}</td>
                            <td>{{ number_format($b->TotalPrice, 0, ',', '.') }}đ</td>
                            <td>{{ $b->BookingStatus }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-cancel-booking"
                                    data-url="{{ route('User.booking.cancel', $b->BookingID) }}">
                                    <i class="fas fa-times-circle"></i> Hủy
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

            <!-- Tab Lịch Hẹn -->
            <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
                {{-- Hiển thị lỗi nếu có --}}
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Nếu không có lịch hẹn, show alert --}}
                @if($appointments->isEmpty())
                <div class="alert alert-info text-center">Bạn chưa có lịch hẹn nào.</div>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dịch vụ</th>
                            <th>Địa điểm</th>
                            <th>Ngày hẹn/Giờ</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th> {{-- Thêm cột để chứa nút Hủy --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $appointment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $appointment->ServiceName }}</td>
                            <td>{{ $appointment->LocationName }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($appointment->AppointmentDate)) }}</td>
                            <td>{{ $appointment->Status }}</td>
                            <td>
                                @if(in_array($appointment->Status, ['Chờ xác nhận', 'Đã xác nhận']))
                                <button
                                    type="button"
                                    class="btn btn-danger btn-cancel-appointment"
                                    data-url="{{ route('User.appointment.cancel', $appointment->AppointmentID) }}"
                                    data-id="{{ $appointment->AppointmentID }}">
                                    <i class="fas fa-times-circle"></i> Hủy lịch hẹn
                                </button>
                                @else
                                <span class="text-secondary">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal Hủy Lịch Hẹn -->
    <div class="modal fade" id="cancelAppointmentModal" tabindex="-1" aria-labelledby="cancelAppointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="cancelAppointmentForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lý do hủy lịch hẹn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="CancellationReason" class="form-label">Chọn lý do:</label>
                            <select name="CancellationReason" id="CancellationReason" class="form-select" required>
                                <option value="">-- Vui lòng chọn lý do --</option>
                                <option value="Thay đổi địa điểm">Thay đổi địa điểm</option>
                                <option value="Thay đổi dịch vụ">Thay đổi dịch vụ</option>
                                <option value="Sai thông tin">Sai thông tin lịch hẹn</option>
                                <option value="Không còn nhu cầu">Không còn nhu cầu</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="mb-3" id="otherReasonBox" style="display: none;">
                            <label for="other_reason" class="form-label">Nhập lý do khác:</label>
                            <input type="text" name="other_reason" id="other_reason" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal hủy phòng -->
    <div class="modal fade" id="cancelBookingModal" tabindex="-1" aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="cancelBookingForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelBookingModalLabel">Lý do hủy đặt phòng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="CancellationReason" class="form-label">Chọn lý do:</label>
                            <select name="CancellationReason" id="CancellationReason" class="form-select" required>
                                <option value="">-- Vui lòng chọn lý do --</option>
                                <option value="Thay đổi cơ sở gửi">Thay đổi cơ sở gửi</option>
                                <option value="Giá quá cao">Giá quá cao</option>
                                <option value="Sai thông tin ngày gửi">Sai thông tin ngày gửi</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="mb-3" id="otherReasonBox" style="display: none;">
                            <label for="other_reason" class="form-label">Nhập lý do khác:</label>
                            <input type="text" name="other_reason" id="other_reason" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}", "Thành công", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        toastr.error("{{ session('error') }}", "Lỗi", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
        });
    </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelButtons = document.querySelectorAll('.btn-cancel-appointment');
            const cancelForm = document.getElementById('cancelAppointmentForm');
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelAppointmentModal'));
            const cancellationReasonSelect = document.getElementById('CancellationReason');
            const otherReasonBox = document.getElementById('otherReasonBox');
            const otherReasonInput = document.getElementById('other_reason');

            // Gắn sự kiện mở modal
            cancelButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const url = button.getAttribute('data-url');
                    cancelForm.setAttribute('action', url);
                    cancelModal.show();
                });
            });

            // Hiện input lý do khác nếu chọn "Khác"
            cancellationReasonSelect.addEventListener('change', () => {
                otherReasonBox.style.display = cancellationReasonSelect.value === 'Khác' ? 'block' : 'none';
            });

            // Kiểm tra nếu chọn "Khác" thì phải nhập lý do
            cancelForm.addEventListener('submit', function(e) {
                if (cancellationReasonSelect.value === 'Khác' && !otherReasonInput.value.trim()) {
                    e.preventDefault();
                    alert('Vui lòng nhập lý do khác.');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelButtons = document.querySelectorAll('.btn-cancel-booking');
            const cancelForm = document.getElementById('cancelBookingForm');
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelBookingModal'));
            const cancellationReasonSelect = document.getElementById('CancellationReason');
            const otherReasonBox = document.getElementById('otherReasonBox');
            const otherReasonInput = document.getElementById('other_reason');

            cancelButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const url = button.getAttribute('data-url');
                    cancelForm.setAttribute('action', url);
                    cancelModal.show();
                });
            });

            cancellationReasonSelect.addEventListener('change', () => {
                if (cancellationReasonSelect.value === 'Khác') {
                    otherReasonBox.style.display = 'block';
                } else {
                    otherReasonBox.style.display = 'none';
                    otherReasonInput.value = '';
                }
            });

            cancelForm.addEventListener('submit', function(e) {
                if (cancellationReasonSelect.value === 'Khác' && !otherReasonInput.value.trim()) {
                    e.preventDefault();
                    alert('Vui lòng nhập lý do khác.');
                }
            });
        });
    </script>
</body>

</html>