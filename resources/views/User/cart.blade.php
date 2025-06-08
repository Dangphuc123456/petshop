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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <div class="cart-views" id="product-list">
        <h2 style="color: #ff6600;">Giỏ hàng của bạn</h2>
        @if(!empty($cart) && count($cart) > 0)
        <div class="cart-content">
            <table class="cart-table" style="border: none !important;outline: none;">
                <thead>
                    <tr>
                        <th></th>
                        <th>SẢN PHẨM</th>
                        <th>GIÁ</th>
                        <th>SỐ LƯỢNG</th>
                        <th>TẠM TÍNH</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $pet_id => $item)
                    <tr>
                        <td>
                            <form action="{{ route('removeFromCart', $pet_id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td class="product-info">
                            <img src="{{ asset('anh/' . $item['image']) }}" class="product-image">
                            <span>{{ $item['name'] }}</span>
                        </td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                        <td>
                            <div class="quantity-control">
                                <button type="button" class="decrease" onclick="updateQuantity(this, -1)">-</button>
                                <input type="number" name="quantity[]" data-id="{{ $pet_id }}" value="{{ $item['quantity'] }}" min="1">

                                <button type="button" class="increase" onclick="updateQuantity(this, 1)">+</button>
                            </div>
                        </td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <h3 style="margin-bottom: 10px;">Tổng giỏ hàng</h3>
                <hr>
                <table>
                    <tr>
                        <td>Tổng cộng</td>
                        <td>{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                    </tr>
                    <tr>
                        <td>Phí vận chuyển</td>
                        <td>0 đ</td>
                    </tr>
                    <tr>
                        <td><strong>Tổng</strong></td>
                        <td><strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></td>
                    </tr>
                </table>
               <a href="{{ route('User.checkout.index') }}"><button class="checkout-btn">TIẾN HÀNH THANH TOÁN</button></a>
                <!-- <div class="discount-section">
                    <label for="discount-code">Mã ưu đãi</label>
                    <input type="text" id="discount-code" placeholder="Mã ưu đãi" style="margin-bottom: 5px;">
                    <button class="apply-btn">Áp dụng</button>
                </div> -->
            </div>
        </div>
        @else
        <p style="text-align: center;">Giỏ hàng trống.</p>
        <a href="{{ route('User.home') }}"><button class="home">Quay lại trang chủ</button></a>
        @endif
        <div class="cart-actions">
            <a href="{{ route('User.home') }}" class="continue-shopping">← TIẾP TỤC XEM SẢN PHẨM</a>
            <button type="button" id="update-cart-btn" class="update-cart">CẬP NHẬT GIỎ HÀNG</button>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"> </script>
    <script src="{{ asset('js/loading.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Xử lý tăng/giảm số lượng ngay lập tức
            $(".quantity-control button").click(function() {
                let input = $(this).siblings("input");
                let petId = input.data("id");
                let currentQuantity = parseInt(input.val());
                let change = $(this).hasClass("increase") ? 1 : -1;
                let newQuantity = Math.max(1, currentQuantity + change); // Không cho phép số lượng < 1

                input.val(newQuantity); // Cập nhật UI ngay

                // Gửi AJAX để cập nhật giỏ hàng
                updateCartQuantity(petId, newQuantity);
            });

            // Xử lý cập nhật khi nhấn "CẬP NHẬT GIỎ HÀNG"
            $("#update-cart-btn").click(function() {
                let cartData = [];
                $("input[name='quantity[]']").each(function() {
                    let petId = $(this).data("id");
                    let quantity = $(this).val();
                    cartData.push({
                        pet_id: petId,
                        quantity: quantity
                    });
                });

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cart: cartData
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Reload trang để cập nhật giỏ hàng
                        } else {
                            alert("Cập nhật thất bại!");
                        }
                    },
                    error: function() {
                        alert("Có lỗi xảy ra khi cập nhật giỏ hàng.");
                    }
                });
            });

            // Hàm AJAX cập nhật số lượng từng sản phẩm
            function updateCartQuantity(petId, newQuantity) {
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        pet_id: petId,
                        quantity: newQuantity
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Cập nhật lại giỏ hàng
                        }
                    },
                });
            }
        });
    </script>
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
</body>

</html>