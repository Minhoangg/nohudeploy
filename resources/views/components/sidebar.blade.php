<div class="sidebar">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/logo.jpg') }}" alt="navbar brand" class="navbar-brand" height="60" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Quản lý</h4>
                </li>

                @if (auth()->user()->role == 1)
                {{-- <li class="nav-item">
                    <a href="{{ route('system.adminAccount-getall') }}">
                        <i class="fas fa-user"></i>
                        <p>Admin</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('system.user-getall') }}">
                        <i class="fas fa-user"></i>
                        <p>Người dùng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('system.lobby-list')}}">
                        <i class="fas fa-user"></i>
                        <p>Sảnh game</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('system.game-getall') }}">
                        <i class="fas fa-user"></i>
                        <p>game</p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('system.user-getall') }}">
                        <i class="fas fa-user"></i>
                        <p>Người dùng</p>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>