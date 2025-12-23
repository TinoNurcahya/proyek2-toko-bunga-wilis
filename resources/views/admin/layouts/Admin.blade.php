<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - Admin Panel</title>

    <!-- AdminLTE + Bootstrap + FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

    @stack('styles')

    <style>
        body { background: #f5f7fb !important; }

        /* Sidebar */
        .main-sidebar {
            background: #ffffff !important;
            border-right: 1px solid #e5eaf2;
        }

        .brand-link {
            background: #fff;
            color: #2e7d32 !important;
            font-weight: 700;
            font-size: 22px;
            border-bottom: none;
        }

        .sidebar .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 6px 10px;
            border-radius: 12px;
        }

        .sidebar .nav-link.active {
            background: #4caf50 !important;
            color: #fff !important;
            box-shadow: 0 4px 10px rgba(76,175,80,.3);
        }

        /* Navbar */
        .main-header {
            background: #ffffff !important;
            border-bottom: none !important;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
            padding: 12px 20px;
        }

        .navbar-title {
            font-size: 20px;
            font-weight: 700;
            color: #2e7d32;
        }

        .glass-search {
            background: rgba(255,255,255,.6);
            border: 1px solid #a5d6a7;
            border-radius: 20px;
            padding: 6px 14px;
            display: flex;
            align-items: center;
        }

        .glass-search input {
            background: transparent;
            border: none;
            outline: none;
            width: 180px;
        }

        /* Avatar */
        .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #4caf50;
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .content-wrapper {
            background: #f5f7fb !important;
            padding: 25px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- NAVBAR -->
    <nav class="main-header navbar navbar-expand navbar-white">
        <span class="navbar-title">@yield('page-title', 'Admin Panel')</span>

        <ul class="navbar-nav ml-auto align-items-center">

            <!-- SEARCH -->
            <li class="nav-item mr-3">
                <div class="glass-search">
                    <i class="fas fa-search text-success mr-2"></i>
                    <input type="text" placeholder="Cari...">
                </div>
            </li>

            <!-- NOTIF -->
            <li class="nav-item dropdown mr-3">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell text-success"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right shadow">
                    <span class="dropdown-item-text font-weight-bold">Notifikasi</span>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item text-muted">Tidak ada notifikasi baru</span>
                </div>
            </li>

            <!-- AVATAR -->
            <li class="nav-item dropdown">
                <a class="nav-link p-0" data-toggle="dropdown" href="#">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(Auth::user()->nama ?? 'V', 0, 1)) }}
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-right shadow">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger font-weight-bold"
                                onclick="return confirm('Yakin ingin logout?')">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </nav>

    <!-- SIDEBAR -->
    <aside class="main-sidebar elevation-3">
        <a href="#" class="brand-link text-center py-3">Willis Garden</a>

        <div class="sidebar mt-3">
            <nav>
                <ul class="nav nav-pills nav-sidebar flex-column">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders') }}"
                           class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Kelola Order</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.iot') }}"
                           class="nav-link {{ request()->routeIs('admin.iot') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-leaf"></i>
                            <p>IoT Monitoring</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.tanaman') }}"
                           class="nav-link {{ request()->routeIs('admin.tanaman') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>Kelola Tanaman</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- CONTENT -->
    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@yield('scripts')

@stack('scripts')

</body>
</html>
