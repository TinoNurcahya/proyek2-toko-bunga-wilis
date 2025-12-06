<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>

    <!-- AdminLTE -->
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

        .top-search {
            border: 1px solid #d4dce7;
            border-radius: 20px;
            padding: 5px 12px;
            width: 250px;
        }
        .top-search input {
            border: none;
            outline: none;
            width: 200px;
        }

        .profile-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #ff7043;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
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
    <nav class="main-header navbar navbar-expand">
        <ul class="navbar-nav mr-auto"></ul>

        <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item">
                <div class="top-search d-flex align-items-center">
                    <i class="fas fa-search mr-2 text-secondary"></i>
                    <input type="text" placeholder="Search...">
                </div>
            </li>
            <li class="nav-item ml-3">
                <a class="nav-link"><i class="fas fa-cog fa-lg text-secondary"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"><i class="fas fa-bell fa-lg text-secondary"></i></a>
            </li>
            <li class="nav-item ml-3">
                <div class="profile-circle"><i class="fas fa-user"></i></div>
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
                           class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Kelola Order</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-leaf"></i>
                            <p>IoT Monitoring</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
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

        {{-- =======================
            YOUR DASHBOARD CONTENT
        ======================== --}}
        @yield('content')

        <!-- GRAFIK + TABLE -->
        <div class="row mt-4">

            <!-- CHART -->
            <section class="col-lg-8 connectedSortable">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title">
                            <i class="fas fa-seedling mr-1"></i> Statistik Penjualan Tanaman
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" style="height: 320px;"></canvas>
                    </div>
                </div>
            </section>

            <!-- TABLE -->
            <section class="col-lg-4 connectedSortable">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title">
                            <i class="fas fa-leaf mr-1"></i> Produk Terlaris
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Tanaman</th>
                                    <th>Terjual</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Monstera Deliciosa</td>
                                    <td>120</td>
                                    <td><span class="badge badge-success">Best Seller</span></td>
                                </tr>
                                <tr>
                                    <td>Calathea Orbifolia</td>
                                    <td>85</td>
                                    <td><span class="badge badge-primary">Populer</span></td>
                                </tr>
                                <tr>
                                    <td>Sansevieria</td>
                                    <td>60</td>
                                    <td><span class="badge badge-warning">Stabil</span></td>
                                </tr>
                                <tr>
                                    <td>Philodendron Birkin</td>
                                    <td>40</td>
                                    <td><span class="badge badge-info">Baru</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

    </div><!-- END CONTENT -->

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('salesChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul'],
        datasets: [{
            label: 'Jumlah Penjualan',
            data: [50,75,60,90,120,110,150],
            fill: true,
            borderWidth: 2,
            borderColor: '#28a745',
            backgroundColor: 'rgba(40,167,69,0.2)',
            tension: .3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
