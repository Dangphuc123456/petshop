<header class="header">
    <!-- Thanh thông tin cửa hàng & tài khoản -->
    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <span>📍Cửa Hàng Miền Bắc: Số 293 Minh Khai, Quận Hai Bà Trưng, Tp. Hà Nội.</span>
            <span>📍Cửa Hàng Miền Nam: 1045 Đường Kha Vạn Cân, Phường Linh Trung, Thủ Đức, Tp.HCM.</span>

            <div class="user-info">
                @if (Auth::guard('customer')->check())
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> {{ Auth::guard('customer')->user()->name }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('User.orders.pending') }}">Đơn Hàng</a>
                        <a class="dropdown-item" href="{{ route('User.orders.completed') }}">Lịch Sử Mua Hàng</a>
                        <a class="dropdown-item" href="{{ route('User.orders.appointment') }}">Lịch Hẹn & Đặt Phòng</a>
                        <a class="dropdown-item" href="{{ route('User.orders.servicehistory') }}">Lịch Sử Dịch vụ</a>
                        <a class="dropdown-item" href="{{ route('User.orders.profile') }}">Trang Cá Nhân</a>
                        <a class="dropdown-item" href="{{ route('User.logout') }}">Đăng Xuất</a>
                    </div>
                </div>
                @else
                <div class="auth-buttons d-flex gap-2">
                    <a href="{{ route('User.login') }}" class="btn btn-outline-light" style="height: 60px;">Đăng <br>nhập</a>
                    <a href="{{ route('User.register') }}" class="btn btn-warning" style="height: 60px;">Đăng <br>ký</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Thanh menu chính -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu chính -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link home-link" href="{{ route('User.home') }}">
                            ≡ TRANG CHỦ
                            <span class="dropdown-toggle-icon" data-bs-toggle="dropdown"></span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('User.about') }}">VỀ CHÚNG TÔI</a>
                            <a class="dropdown-item" href="{{ route('User.serviceandhotel') }}">DỊCH VỤ SPA & HOTEL</a>
                            <a class="dropdown-item" href="{{ route('User.about') }}">CHÍNH SÁCH BẢO HÀNH</a>
                            <a class="dropdown-item" href="{{ route('User.news') }}">TIN TỨC</a>
                            <a class="dropdown-item" href="{{ route('User.contact') }}">LIÊN HỆ</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🐶 CHÓ CẢNH</a>
                        <div class="dropdown-menu">
                            @foreach($dogCategories as $dog)
                            <a class="dropdown-item" href="{{ route('User.category', ['category_id' => $dog->category_id, 'category_name' => urlencode($dog->category_name)]) }}">{{ $dog->category_name }}</a>
                            @endforeach
                            <a class="dropdown-item border-top text-center fw-bold" href="{{ route('User.product', ['type' => 'dogs']) }}">Tất cả chó cảnh</a>
                        </div>
                    </li>

                    <!-- Danh mục Mèo -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🐱 MÈO CẢNH</a>
                        <div class="dropdown-menu">
                            @foreach($catCategories as $cat)
                            <a class="dropdown-item" href="{{ route('User.category', ['category_id' => $cat->category_id, 'category_name' => urlencode($cat->category_name)]) }}">{{ $cat->category_name }}</a>
                            @endforeach
                            <a class="dropdown-item border-top text-center fw-bold" href="{{ route('User.product', ['type' => 'cats']) }}">Tất cả mèo cảnh</a>
                        </div>
                    </li>

                    <!-- Danh mục Phụ kiện -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🎁 PHỤ KIỆN</a>
                        <div class="dropdown-menu">
                            @foreach($accessoryCategories as $accessory)
                            <a class="dropdown-item" href="{{ route('User.category', ['category_id' => $accessory->category_id, 'category_name' => urlencode($accessory->category_name)]) }}">{{ $accessory->category_name }}</a>
                            @endforeach
                            <a class="dropdown-item border-top text-center fw-bold" href="{{ route('User.product', ['type' => 'accessories']) }}">Tất cả phụ kiện</a>
                        </div>
                    </li>
                </ul>

                <!-- Ô tìm kiếm -->
                <div class="search-box">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="query" class="form-control" placeholder="Tìm kiếm..." required>
                        <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                @php
                use Illuminate\Support\Facades\Auth;

                // Mặc định cart rỗng
                $cart = [];

                // Nếu khách hàng đã đăng nhập, lấy giỏ hàng theo ID người dùng
                if (Auth::guard('customer')->check()) {
                $userId = Auth::guard('customer')->id();
                $cart = session('cart_' . $userId, []);
                }
                @endphp

                <div class="header-icons d-flex align-items-center">
                    <a href="tel:+84964505836" class="phone">
                        <i class="fas fa-phone"></i> 0964 505 836
                    </a>
                    <div class="cart-container">
                        <a href="{{ route('User.cart') }}" class="cart">
                            <i class="fas fa-shopping-cart"></i>
                            @if(!empty($cart) && count($cart) > 0)
                            <span class="cart-count">{{ array_sum(array_column($cart, 'quantity')) }}</span>
                            @endif
                        </a>
                        <div class="cart-tooltip">
                            @if(!empty($cart) && count($cart) > 0)
                            @foreach($cart as $pet_id => $item)
                            <div class="cart-item">
                                <img src="{{ asset('anh/' . $item['image']) }}" class="cart-item-image">
                                <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                            </div>
                            <hr>
                            @endforeach
                            <a href="{{ route('User.cart') }}" class="btn-view-cart">Xem giỏ hàng</a>
                            @else
                            <p>Chưa có sản phẩm trong giỏ hàng.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>