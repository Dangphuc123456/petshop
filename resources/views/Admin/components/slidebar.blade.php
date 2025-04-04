<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class='fas fa-audio-description'></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN-PETS-SHOP</div>
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
            <span>Quản lý danh sách lịch hẹn</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.booking.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Quản lý danh sách đặt phòng</span>
        </a>
        <!-- Always visible List Categories link -->
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.category.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="far fa-list-alt"></i>
            <span>Quản lý danh sách loại </span>
        </a>
        <!-- Always visible List Pets link -->
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.pets.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Quản lý danh sách sản phẩm</span>
        </a>
        <!-- Always visible List Orders link -->
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.order.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Quản lý danh sách hóa đơn bán</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.inputinvoi.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Quản lý danh sách hóa đơn nhập</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.suppliers.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Quản lý danh sách nhà cung cấp</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.room.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Quản lý danh sách phòng</span>
        </a>
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.new.index') }}"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Quản lý danh bài viết</span>
        </a>
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