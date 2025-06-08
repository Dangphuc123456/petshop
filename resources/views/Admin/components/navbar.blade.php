<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form action="{{ route('admin.search.index') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request('query') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span id="order-alert-count" class="badge badge-danger badge-counter">0</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Đơn Hàng Mới</h6>
                <div id="order-alerts-container">
                    <p class="text-center small text-gray-500">Không có đơn hàng mới</p>
                </div>
                @if(Auth::guard('admin')->check())
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.order.index') }}">
                    Xem Tất Cả
                </a>
                @else
                <a class="dropdown-item text-center small text-danger" href="{{ route('admin.login') }}" title="Bạn cần đăng nhập để xem tất cả">
                    Đăng nhập để xem tất cả
                </a>
                @endif
            </div>
        </li>

        <script>
            // Fetch notifications using AJAX
            function fetchNewOrders() {
                fetch('/admin/notifications/new-orders')
                    .then(response => response.json())
                    .then(data => {
                        const alertsContainer = document.getElementById('order-alerts-container');
                        const alertCount = document.getElementById('order-alert-count');

                        alertsContainer.innerHTML = '';

                        if (data.length > 0) {
                            alertCount.textContent = data.length;

                            data.forEach(order => {
                                // Tạo tuyến đường bằng cách sử dụng trình trợ giúp tuyến đường của Laravel
                                const orderUrl = `/admin/order/show/${order.order_id}`; // URL động

                                alertsContainer.innerHTML += `
                            <a class="dropdown-item d-flex align-items-center" href="${orderUrl}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-shopping-cart text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">${new Date(order.created_at).toLocaleString()}</div>
                                    <span class="font-weight-bold">Khách hàng: ${order.customer_name}</span>
                                    <div class="text-gray-500">Số tiền: ${Number(order.total_amount).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</div>

                                </div>
                            </a>
                        `;
                            });
                        } else {
                            alertCount.textContent = '0';
                            alertsContainer.innerHTML = `<p class="text-center small text-gray-500">Không có đơn hàng mới</p>`;
                        }
                    });
            }

            // Poll every 30 seconds
            setInterval(fetchNewOrders, 30000);

            // Initial fetch on page load
            document.addEventListener('DOMContentLoaded', fetchNewOrders);
        </script>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="calendarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-calendar-day fa-fw me-1"></i>
                <span id="calendar-alert-count" class="badge badge-danger badge-counter">0</span>
            </a>
            <!-- Dropdown - Calendar -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="calendarDropdown" style="min-width: 350px;">
                <h6 class="dropdown-header">Lịch Hẹn & Đặt Phòng </h6>
                <div id="calendar-alerts-container">
                    <p class="text-center small text-gray-500">Đang tải dữ liệu...</p>
                </div>
                <div class="dropdown-divider"></div>

                @if(Auth::guard('admin')->check())
                <a class="dropdown-item text-center small text-primary" href="{{ route('admin.appointments.index') }}">
                    Xem tất cả lịch hẹn
                </a>
                @else
                <a class="dropdown-item text-center small text-danger" href="{{ route('admin.login') }}" title="Bạn cần đăng nhập để xem tất cả">
                    Đăng nhập để xem tất cả lịch hẹn
                </a>
                @endif

                <div class="dropdown-divider"></div>

                @if(Auth::guard('admin')->check())
                <a class="dropdown-item text-center small text-primary" href="{{ route('admin.booking.index') }}">
                    Xem tất cả đặt phòng
                </a>
                @else
                <a class="dropdown-item text-center small text-danger" href="{{ route('admin.login') }}" title="Bạn cần đăng nhập để xem tất cả">
                    Đăng nhập để xem tất cả đặt phòng
                </a>
                @endif

            </div>
        </li>
        <script>
            // Hàm fetch lịch hẹn và đặt phòng mới
            function fetchNewCalendar() {
                fetch('/admin/notifications/calendar')
                    .then(response => response.json())
                    .then(data => {
                        const alertsContainer = document.getElementById('calendar-alerts-container');
                        const alertCount = document.getElementById('calendar-alert-count');

                        alertsContainer.innerHTML = '';

                        let count = 0;

                        // Xử lý lịch hẹn
                        if (data.appointments && data.appointments.length > 0) {
                            data.appointments.forEach(app => {
                                count++;

                                const appointmentUrl = `/admin/appointments/show/${app.AppointmentID}`;

                                alertsContainer.innerHTML += `
                            <a class="dropdown-item d-flex align-items-center" href="${appointmentUrl}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-user-clock text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">${new Date(app.created_at).toLocaleString()}</div>
                                    <span class="font-weight-bold">Lịch hẹn: ${app.CustomerName} - ${app.AppointmentDate}</span>
                                    <div class="text-gray-500">${app.ServiceName} tại ${app.LocationName}</div>
                                </div>
                            </a>
                        `;
                            });
                        }

                        // Xử lý đặt phòng
                        if (data.bookings && data.bookings.length > 0) {
                            data.bookings.forEach(book => {
                                count++;

                                const bookingUrl = `/admin/booking/show/${book.BookingID}`;

                                alertsContainer.innerHTML += `
                            <a class="dropdown-item d-flex align-items-center" href="${bookingUrl}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-bed text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">${new Date(book.created_at).toLocaleString()}</div>
                                    <span class="font-weight-bold">Đặt phòng: ${book.CustomerName}</span>
                                    <div class="text-gray-500">Nhận: ${book.CheckInDate} - Trả: ${book.CheckOutDate}</div>
                                </div>
                            </a>
                        `;
                            });
                        }

                        alertCount.textContent = count;

                        if (count === 0) {
                            alertsContainer.innerHTML = `<p class="text-center small text-gray-500">Không có lịch hẹn/đặt phòng mới</p>`;
                        }
                    });
            }
            setInterval(fetchNewCalendar, 30000);

            // Gọi ngay khi trang vừa load
            document.addEventListener('DOMContentLoaded', fetchNewCalendar);
        </script>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ Auth::guard('admin')->user()->name ?? 'Guest' }}
                </span>
                <img style="height: 50px;width:50px" src="{{ asset('anh/user.png') }}" alt="Pet">
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.login') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Login
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>