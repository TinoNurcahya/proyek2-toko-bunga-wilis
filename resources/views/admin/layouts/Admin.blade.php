<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- AdminLTE + Bootstrap + FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

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
            color: white !important;
            box-shadow: 0 4px 10px rgba(76,175,80,.3);
        }

        /* Navbar */
        .main-header {
            background: #ffffff !important;
            border-bottom: none !important;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
            padding: 12px 20px;
        }

        .glass-search {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid #a5d6a7;
            border-radius: 20px;
            padding: 6px 14px;
            width: 250px;
            display: flex;
            align-items: center;
        }
        .glass-search input {
            background: transparent;
            border: none;
            outline: none;
            width: 200px;
            color: #2e7d32;
            font-weight: 500;
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #2e7d32;
        }

        .content-wrapper {
            background: #f5f7fb !important;
            padding: 25px;
        }

        .navbar-title {
            font-size: 20px;
            font-weight: 700;
            color: #2e7d32;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- NAVBAR -->
    <nav class="main-header navbar navbar-expand d-flex justify-content-between align-items-center">
        <!-- Tulisan Overview -->
        <div class="navbar-title">Overview</div>

        <!-- Kanan: Search + Ikon + Avatar -->
        <div class="d-flex align-items-center gap-3">
            <!-- Search transparan -->
            <div class="glass-search">
                <i class="fas fa-search mr-2 text-success"></i>
                <input type="text" placeholder="Search...">
            </div>

            <!-- Ikon hijau -->
            <a class="nav-link"><i class="fas fa-cog fa-lg text-success"></i></a>
            <a class="nav-link"><i class="fas fa-bell fa-lg text-success"></i></a>

            <!-- Avatar pakai gambar -->
            <img src="https://example.com/avatar.jpg" alt="Admin Avatar" class="profile-avatar">
        </div>
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
                        <a href="{{ route('admin.iot') }}" class="nav-link {{ request()->routeIs('admin.iot') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-leaf"></i>
                            <p>IoT Monitoring</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.tanaman') }}" class="nav-link {{ request()->routeIs('admin.tanaman') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>Kelola Tanaman</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- CONTENT WRAPPER -->
    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@yield('scripts')
</body>
</html>