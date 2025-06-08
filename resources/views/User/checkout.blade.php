<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <div class="container mt-5 mb-5">
        <form action="{{ route('User.checkout.payment') }}" method="POST">
            @csrf
            <div class="row">
                <!-- THÔNG TIN ĐƠN HÀNG -->
                <div class="col-md-7 mb-4">
                    <div class="card shadow-sm p-3">
                        <h4 class="mb-3">Thông tin đơn hàng</h4>
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('anh/' . $item['image']) }}" class="img-thumbnail" width="80">
                                    </td>
                                    <td>{{ $item['name'] }}</td>
                                    <td class="text-center">{{ $item['quantity'] }}</td>
                                    <td class="text-end">{{ number_format($item['price'], 0, ',', '.') }}VNĐ</td>
                                    <td class="text-end">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}VNĐ</td>

                                    <!-- hidden fields -->
                                    <input type="hidden" name="order_items[{{ $id }}][pet_id]" value="{{ $id }}">
                                    <input type="hidden" name="order_items[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                                    <input type="hidden" name="order_items[{{ $id }}][price]" value="{{ $item['price'] }}">
                                    <input type="hidden" name="order_items[{{ $id }}][name]" value="{{ $item['name'] }}">
                                    <input type="hidden" name="order_items[{{ $id }}][image_url]" value="{{ $item['image'] }}">
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h5 class="text-end">Tổng tiền: <strong>{{ number_format($totalPrice, 0, ',', '.') }}VNĐ</strong></h5>
                        <input type="hidden" name="total_amount" value="{{ $totalPrice }}">
                    </div>
                </div>

                <!-- THÔNG TIN KHÁCH HÀNG -->
                <div class="col-md-5 mb-4">
                    <div class="card shadow-sm p-3">
                        <h4 class="mb-3">Thông tin khách hàng</h4>
                        <div class="form-group mb-3">
                            <label for="customer_name">Họ và tên *</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại *</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Địa chỉ *</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="postal_code">Mã bưu chính *</label>
                            <input type="text" name="postal_code" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="payment">Phương thức thanh toán *</label>
                            <select name="payment" class="form-control" required>
                                <option value="Cod">Thanh toán khi nhận hàng</option>
                                <option value="vnpay">VNPAY</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/loading.js') }}"></script>
</body>

</html>