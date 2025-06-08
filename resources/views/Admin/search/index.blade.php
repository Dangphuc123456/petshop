@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')

<div class="container">
    <h5>Search Results for "{{ $query }}"</h5>

    {{-- Nếu có sản phẩm --}}
@if(!$pets->isEmpty())
    <h2>Pets</h2>
    <table class="table table-bordered>
        <thead>
            <tr style="text-align: center;">
                <th>STT</th>
                <th>Mô Tả</th>
                <th>Gía</th>
                <th>Ảnh</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td>{{ $pet->pet_id }}</td>
                <td>{{ $pet->description }}</td>
                <td>{{ number_format($pet->price, 0, ',', '.') }}đ</td>
                <td><img class="img_SP" src="{{ asset('anh/' . $pet->image_url) }}" alt="Product image" style="width:100px;height:100px;text-align: center;"></td>
                <td>
                    <a href="{{ route('admin.pets.edit', $pet->pet_id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('admin.pets.detail', $pet->pet_id) }}" class="btn btn-success">Show</a>
                    <form action="{{ route('pets.destroy', $pet->pet_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{-- Nếu không có sản phẩm, kiểm tra đơn hàng bán --}}
@elseif(!$orders->isEmpty())
    <h2>Đơn hàng bán</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
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
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                <td>{{ $order->status }}</td>
                <td class="order-cell">
                    @if($order->status != 'Đã hủy' && $order->status != 'Hoàn thành')
                    <form action="{{ route('admin.order.confirm', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success uniform-width" {{ $order->status == 'Đã xác nhận' ? 'disabled' : '' }}>Xác nhận</button>
                    </form>
                    <form action="{{ route('admin.order.delivery', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning uniform-width" {{ $order->status == 'Đang giao hàng' || $order->status == 'Hoàn thành' ? 'disabled' : '' }}>Đang giao</button>
                    </form>
                    <form action="{{ route('admin.order.delivered', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success uniform-width" {{ $order->status == 'Hoàn thành' ? 'disabled' : '' }}>Hoàn thành</button>
                    </form>
                    <form action="{{ route('admin.order.cancel', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger uniform-width" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">Hủy Đơn</button>
                    </form>
                    @else
                    @if($order->status == 'Đã hủy')
                    <span class="badge bg-danger">Đã hủy</span>
                    @elseif($order->status == 'Hoàn thành')
                    <span class="badge bg-success">Hoàn thành</span>
                    @endif
                    @endif
                    <a href="{{ route('admin.order.show', ['order_id' => $order->order_id]) }}">
                        <button class="btn btn-eye uniform-width" style="color: white;border:0;border-radius: 5px;;background-color:#3366CC;height:40px">Chi Tiết </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{-- Nếu không có đơn hàng bán, kiểm tra đơn hàng nhập --}}
@elseif(!$purchaseOrders->isEmpty())
    <h2>Đơn hàng nhập</h2>
    <table class="table table-bordered">
         <thead>
            <tr>
                <th>STT</th>
                <th>Mã NCC</th>
                <th>Ngày đặt hàng</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrders as $purchaseOrder)
            <tr>
                <td>{{ $purchaseOrder->purchase_order_id }}</td>
                <td>{{ $purchaseOrder->supplier_id }}</td>
                <td>{{ $purchaseOrder->order_date }}</td>
                <td>{{ number_format($purchaseOrder->total_amount, 0, ',', '.') }}đ</td>
                <td style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                    <a href="{{ route('admin.inputinvoi.edit', $purchaseOrder->purchase_order_id) }}">
                        <button style="background-color: #FFCC33;border: none; outline: none;padding:8px;"><i class='fas fa-edit'></i></button>
                    </a>
                    <a href="{{ route('admin.inputinvoi.detail', $purchaseOrder->purchase_order_id) }}">
                        <button style="background-color: green; color: white;border: none; outline: none;padding:8px;"><i class="fa fa-eye"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{-- Nếu không có đơn hàng nhập, kiểm tra phòng --}}
@elseif(!$room->isEmpty())
    <h2>Phòng</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Gía/ngày</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($room as $rooms)
            <tr>
                <td>{{ $rooms->RoomID }}</td>
                <td>{{ number_format($rooms->PricePerNight, 0, ',', '.') }}đ</td>
                <td>{{ ucfirst($rooms->Status) }}</td>
                <td>
                    @if (!empty($rooms->Status))
                    <div style="display: flex; gap: 10px;">
                        <form action="{{ route('admin.room.available', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Available</button>
                        </form>
                        <form action="{{ route('admin.room.occupied', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Occupied</button>
                        </form>
                        <form action="{{ route('admin.room.maintenance', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info">Maintenance</button>
                        </form>
                        <a href="{{ route('admin.room.detail', $rooms->RoomID) }}" class="btn-edit">
                            <button class="btn-delete" style="background-color:green;border:0px;padding:7px; border-radius: 5px;">Chi tiết</button>
                        </a>
                        <form action="{{ route('room.destroy', $rooms->RoomID) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" style="background-color:red;border:0px;padding:7px; border-radius: 5px;" onclick="return confirm('Bạn có chắc chắn muốn xóa phòng này?')">Delete</button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{-- Nếu không có phòng, kiểm tra nhà cung cấp --}}
@elseif(!$suppliers->isEmpty())
    <h2>Nhà cung cấp</h2>
    <table class="table table-bordered">
       <thead>
            <tr style="text-align: center;">
                <th>ID</th>
                <th>Name</th>
                <th>Contact Person</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supplier as $supplier)
            <tr>
                <td>{{ $supplier->supplier_id }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->contact_person }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->email }}</td>
                <td style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                    <button class="btn btn-warning btn-edit" data-id="{{ $supplier->supplier_id }}" style="background-color: #FFCC33; border: none; outline: none; padding:8px;">
                        <i class='fas fa-edit'></i>
                    </button>
                    <button class="btn btn-success btn-detail" data-id="{{ $supplier->supplier_id }}" style="background-color: rgb(13, 202, 240);color:black; border: none; outline: none; padding:8px;">
                        <i class="fa fa-eye"></i>
                    </button>
                    <form action="{{ route('suppliers.destroy', $supplier->supplier_id) }}" method="POST" class="form-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhà cung cấp này?');">
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

{{-- Nếu tất cả đều rỗng --}}
@else
    <p>Không có kết quả tìm kiếm nào.</p>
@endif

@endsection