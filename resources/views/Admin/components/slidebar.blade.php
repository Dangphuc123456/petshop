<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class='fas fa-audio-description'></i>
        </div>
        <div class="sidebar-brand-text mx-3">PetShop Management</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('Admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">

    </div>

    <!-- Nav Item - Categories -->
    <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.appointments.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Lịch Hẹn</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.booking.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Phòng Đặt </span>
        </a>

        <!-- Always visible List Pets link -->
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.pets.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Sản phẩm </span>
        </a>
        <!-- Always visible List Orders link -->
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.order.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Đơn Hàng Bán </span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.inputinvoi.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Đơn Hàng Nhập </span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.suppliers.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Nhà cung cấp</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.room.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Phòng Lưu Trú</span>
        </a>
        <!-- Always visible List Categories link -->
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.category.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="far fa-list-alt"></i>
            <span>Danh mục</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.new.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Bài Viết</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.servicee.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Dịch Vụ</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.stats') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-chart-bar"></i>
            <span>Thống kê</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="svDropdown" role="button" data-toggle="collapse" data-target="#svCollapse" aria-expanded="false" aria-controls="svCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-user"></i>
            <span>Người dùng</span>
        </a>
        <div class="collapse" id="svCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.customer.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>Khách hàng</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.employee.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-plus-square"></i>
                <span>Nhân viên</span>
            </a>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.register') }}">
            <i class="fas fa-user-plus"></i>
            <span>Sign Up</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>