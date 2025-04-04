@extends('Admin.admin')
@section('title')
@section('main')
<div class="table-container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="table-title">List of Appointments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Appointment_ID</th>
                <th>Customer_Name</th>
                <th>Appointment_Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointment as $appointment)
            <tr>
                <td>{{ $appointment->AppointmentID }}</td>
                <td>{{ $appointment->CustomerName }}</td>
                <td>{{ $appointment->AppointmentDate }}</td>
                <td>{{ $appointment->Status }}</td>
                <td>
                    @if($appointment->Status != 'Đã hủy' && $appointment->Status != 'Hoàn thành')
                    <form action="{{ route('admin.appointments.confirm', ['AppointmentID' => $appointment->AppointmentID]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $appointment->Status == 'Đã xác nhận' ? 'disabled' : '' }}>Xác nhận</button>
                    </form>
                    <form action="{{ route('admin.appointments.complete', ['AppointmentID' => $appointment->AppointmentID]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $appointment->Status == 'Hoàn thành' ? 'disabled' : '' }}>Hoàn thành</button>
                    </form>
                    <form action="{{ route('admin.appointments.cancel', ['AppointmentID' => $appointment->AppointmentID]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy lịch hẹn này?')">Hủy</button>
                    </form>
                    @else
                    @if($appointment->Status == 'Đã hủy')
                    <span class="badge bg-danger">Đã hủy</span>
                    @elseif($appointment->Status == 'Hoàn thành')
                    <span class="badge bg-success">Hoàn thành</span>
                    @endif
                    @endif

                    <a href="{{ route('admin.appointments.detail', ['AppointmentID' => $appointment->AppointmentID]) }}">
                        <button style="border:0; border-radius:5px; background-color:cornflowerblue; height:40px">Chi Tiết Lịch Hẹn</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection