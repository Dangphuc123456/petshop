<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <form action="{{ route('User.checkout.payment') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7 mb-2">
                <div class="card shadow-sm p-3 mb-4">
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
                                <td class="text-right">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                                <td class="text-right">{{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}đ</td>
                                <input type="hidden" name="order_items[{{ $id }}][pet_id]" value="{{ $id }}">

                                <input type="hidden" name="order_items[{{ $id }}][quantity]" value="{{ $item['quantity'] ?? 1 }}">

                                <input type="hidden" name="order_items[{{ $id }}][price]" value="{{ $item['price'] ?? 0 }}">

                                <input type="hidden" name="order_items[{{ $id }}][name]" value="{{ $item['name'] ?? 'Không có mô tả' }}">

                                <input type="hidden" name="order_items[{{ $id }}][image_url]" value="{{ $item['image'] }}">  
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                                <td class="text-right"><strong>{{ number_format($totalPrice, 0, ',', '.') }}đ</strong></td>
                                <input type="hidden" name="total_amount" value="{{ $totalPrice }}">
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-5 shadow-sm p-4">
                <h4>Thông tin khách hàng</h4>
                <div class="form-group mb-3">
                    <label>Họ tên:</label>
                    <input type="text" name="customer_name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Số điện thoại:</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Địa chỉ:</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Quốc gia:</label>
                    <input type="text" name="country" class="form-control" value="Vietnam">
                </div>
                <div class="form-group mb-3">
                    <label>Mã bưu điện:</label>
                    <input type="text" name="postal_code" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Phương thức thanh toán:</label>
                    <select name="payment" class="form-control" required>
                        <option value="cash">Thanh toán khi nhận hàng (COD)</option>
                        <option value="momo">MoMo</option>
                        <option value="zalopay">ZaloPay</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đặt hàng</button>
            </div>
        </div>
    </form>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>