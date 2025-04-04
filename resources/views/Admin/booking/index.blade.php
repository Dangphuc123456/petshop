@extends('Admin.admin')  
@section('title')  
@section('main')  
<div class="table-container">  
    @if(session('success'))  
    <div class="alert alert-success">  
        {{ session('success') }}  
    </div>  
    @endif  
    <h2 class="table-title">List of Bookings</h2>  
    <table class="table">  
        <thead>  
            <tr>  
                <th>Booking_ID</th>  
                <th>Customer_Name</th>  
                <th>Check-in date</th> 
                <th>Check-out date</th> 
                <th>Status</th>  
                <th>Actions</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach($booking as $bookingItem)  
            <tr>  
                <td>{{ $bookingItem->BookingID }}</td>  
                <td>{{ $bookingItem->customer_name }}</td>  
                <td>{{ $bookingItem->CheckInDate }}</td>  
                <td>{{ $bookingItem->CheckOutDate }}</td>
                <td>{{ $bookingItem->BookingStatus }}</td>  
                <td>  
                    @if($bookingItem->BookingStatus != 'Đã hủy' && $bookingItem->BookingStatus != 'Đã trả phòng')  
                    <form action="{{ route('admin.booking.confirm', ['BookingID' => $bookingItem->BookingID]) }}" method="POST" style="display: inline;">  
                        @csrf  
                        <button type="submit" class="btn btn-success" {{ $bookingItem->BookingStatus == 'Đã xác nhận' ? 'disabled' : '' }}>Xác nhận</button>  
                    </form>  
                    <form action="{{ route('admin.booking.checkout', ['BookingID' => $bookingItem->BookingID]) }}" method="POST" style="display: inline;">  
                        @csrf  
                        <button type="submit" class="btn btn-success" {{ $bookingItem->BookingStatus == 'Đã trả phòng' ? 'disabled' : '' }}>Hoàn thành</button>  
                    </form>  
                    <form action="{{ route('admin.booking.cancel', ['BookingID' => $bookingItem->BookingID]) }}" method="POST" style="display: inline;">  
                        @csrf  
                        @method('DELETE')  
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đặt phòng này?')">Hủy</button>  
                    </form>  
                    @else  
                    @if($bookingItem->BookingStatus == 'Đã hủy')  
                    <span class="badge bg-danger">Đã hủy</span>  
                    @elseif($bookingItem->BookingStatus == 'Đã trả phòng')  
                    <span class="badge bg-success">Đã trả phòng</span>  
                    @endif  
                    @endif  

                    <a href="{{ route('admin.booking.detail', ['BookingID' => $bookingItem->BookingID]) }}">  
                        <button style="border:0; border-radius:5px; background-color:cornflowerblue; height:40px">Chi Tiết Đặt Phòng</button>  
                    </a>  
                </td>  
            </tr>  
            @endforeach  
        </tbody>  
    </table>  
</div>  
@endsection  