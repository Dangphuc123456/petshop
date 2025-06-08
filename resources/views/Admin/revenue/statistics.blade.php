@extends('Admin.admin')
@section('title', 'Thống kê doanh thu')

@section('main')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Thống Kê Doanh Thu Bán</h2>
    <div class="row">
        {{-- Doanh thu theo tuần --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white text-center">Doanh thu tuần</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Đặt Phòng </td>
                            <td>{{ number_format($bookingWeek, 0, ',', '.') }}</td>
                            <td>{{ $bookingCountWeek }} lượt</td>
                        </tr>
                        <tr>
                            <td>Đơn hàng</td>
                            <td>{{ number_format($orderWeek, 0, ',', '.') }}</td>
                            <td> {{ $productSoldWeek }} SP</td>
                        </tr>
                        <tr>
                            <td>Dịch vụ</td>
                            <td>{{ number_format($appointmentWeek, 0, ',', '.') }}</td>
                            <td>{{ $appointmentCountWeek }} lượt</td>
                        </tr>
                        <tr class="table-success">
                            <td>Tổng</td>
                            <td>{{ number_format($totalWeek, 0, ',', '.') }}</th>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Doanh thu theo tháng --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white text-center">Doanh thu tháng</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Đặt Phòng</td>
                            <td>{{ number_format($bookingMonth, 0, ',', '.') }} VND</td>
                            <td>{{ $bookingCountMonth }} lượt</td>
                        </tr>
                        <tr>
                            <td>Đơn hàng</td>
                            <td>{{ number_format($orderMonth, 0, ',', '.') }} VND</td>
                            <td>{{ $productSoldMonth }} SP</td>
                        </tr>
                        <tr>
                            <td>Dịch vụ</td>
                            <td>{{ number_format($appointmentMonth, 0, ',', '.') }} VND</td>
                            <td>{{ $appointmentCountMonth }} lượt</td>
                        </tr>
                        <tr class="table-success">
                            <th>Tổng</th>
                            <th>{{ number_format($totalMonth, 0, ',', '.') }} VND</th>
                            <td></td>
                        </tr>
                    </table>
                    <div class="dropdown text-center mt-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Xuất Excel
                        </button>
                        <div class="dropdown-menu" aria-labelledby="exportDropdown">
                            <a class="dropdown-item" href="{{ route('admin.export.booking_details', ['periodType' => 'month', 'periodValue' => now()->format('Y-m')]) }}">
                                <i class="fas fa-file-excel text-info me-2"></i> Xuất Excel Booking
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.export.order_details', ['periodType' => 'month', 'periodValue' => now()->format('Y-m')]) }}">
                                <i class="fas fa-file-excel text-primary me-2"></i> Xuất Excel Đơn hàng
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.export.appointment_details', ['periodType' => 'month', 'periodValue' => now()->format('Y-m')]) }}">
                                <i class="fas fa-file-excel text-warning me-2"></i> Xuất Excel Dịch vụ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Doanh thu theo năm --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning text-dark text-center">Doanh thu năm</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Đặt Phòng</td>
                            <td>{{ number_format($bookingYear, 0, ',', '.') }} VND</td>
                            <td>{{$bookingCountYear}} lượt</td>
                        </tr>
                        <tr>
                            <td>Đơn hàng</td>
                            <td>{{ number_format($orderYear, 0, ',', '.') }} VND</td>
                            <td>{{$productSoldYear}} SP</td>
                        </tr>
                        <tr>
                            <td>Dịch vụ</td>
                            <td>{{ number_format($appointmentYear, 0, ',', '.') }} VND</td>
                            <td>{{$appointmentCountYear}} lượt</td>
                        </tr>
                        <tr class="table-success">
                            <th>Tổng</th>
                            <th>{{ number_format($totalYear, 0, ',', '.') }} VND</th>
                            <td></td>
                        </tr>
                    </table>
                    <div class="dropdown text-center mt-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Xuất Excel theo năm
                        </button>
                        <div class="dropdown-menu" aria-labelledby="exportDropdown">
                            <a class="dropdown-item" href="{{ route('admin.export.booking_details', ['periodType' => 'year', 'periodValue' => now()->year]) }}">
                                <i class="fas fa-file-excel text-info me-2"></i> Xuất Excel Booking theo năm
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.export.order_details', ['periodType' => 'year', 'periodValue' => now()->year]) }}">
                                <i class="fas fa-file-excel text-primary me-2"></i> Xuất Excel Đơn hàng theo năm
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.export.appointment_details', ['periodType' => 'year', 'periodValue' => now()->year]) }}">
                                <i class="fas fa-file-excel text-warning me-2"></i> Xuất Excel Dịch vụ theo năm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-3 text-center">Thống Kê Doanh Thu Nhập</h2>
    <div class="row justify-content-center">
        {{-- Nhập hàng tháng --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white text-center">
                    Nhập hàng tháng
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Tổng giá trị nhập</td>
                            <td>{{ number_format($purchaseMonth ?? 0, 0, ',', '.') }} VND</td>
                        </tr>
                    </table>

                    {{-- Nút xuất Excel cho tháng hiện tại --}}
                    <a href="{{ route('admin.export.purchase_orders', [
                        'periodType'  => 'month',
                        'periodValue' => now()->format('Y-m')
                    ]) }}"
                        class="btn btn-success w-100 mt-3">
                        <i class="fas fa-file-excel me-2"></i>
                        Xuất Excel 
                    </a>
                </div>
            </div>
        </div>

        {{-- Nhập hàng năm --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white text-center">
                    Nhập hàng năm
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Tổng giá trị nhập</td>
                            <td>{{ number_format($purchaseYear ?? 0, 0, ',', '.') }} VND</td>
                        </tr>
                    </table>

                    {{-- Nút xuất Excel cho năm hiện tại --}}
                    <a href="{{ route('admin.export.purchase_orders', [
                        'periodType'  => 'year',
                        'periodValue' => now()->format('Y')
                    ]) }}"
                        class="btn btn-success w-100 mt-3">
                        <i class="fas fa-file-excel me-2"></i>
                        Xuất Excel 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection