<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Order Admin - AdminLTE</title>

    <!-- AdminLTE 3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-flex align-items-center me-3">
                <span class="fw-bold">{{ $user->name }}</span>
            </li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link text-center">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>

        <div class="sidebar">

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Kelola Order</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Produk</p>
                        </a>
                    </li>

                </ul>
            </nav>

        </div>
    </aside>
    <!-- /.sidebar -->

    <!-- Content -->
    <div class="content-wrapper">

        <!-- Title Section -->
        <section class="content-header">
            <div class="container-fluid">
                <h3 class="fw-bold">Halaman Order Admin</h3>
                <small class="text-muted">Kelola semua data pemesanan pelanggan</small>
            </div>
        </section>

        <!-- Content Body -->
        <section class="content">

            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Order</h4>
                    </div>

                    <div class="card-body">

                        @if ($orders->count() > 0)

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">

                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $o)
                                            <tr class="text-center">

                                                <td>{{ $o->id }}</td>

                                                <td>{{ $o->user->name ?? '-' }}</td>

                                                <td>
                                                    Rp {{ number_format($o->total_harga, 0, ',', '.') }}
                                                </td>

                                                <td>
                                                    <span class="badge 
                                                        @if($o->status === 'completed') badge-success
                                                        @elseif($o->status === 'pending') badge-warning
                                                        @else badge-secondary 
                                                        @endif">
                                                        {{ ucfirst($o->status) }}
                                                    </span>
                                                </td>

                                                <!-- FIXED DATE -->
                                                <td>{{ \Carbon\Carbon::parse($o->created_at)->format('d M Y') }}</td>

                                                <td>

                                                    <a href="{{ route('admin.orders.show', $o->id) }}"
                                                       class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.orders.edit', $o->id) }}"
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.orders.destroy', $o->id) }}"
                                                          method="POST" class="d-inline">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Hapus order?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                        @else
                            <p class="text-muted">Belum ada data order.</p>
                        @endif

                    </div>
                </div>

            </div>

        </section>

    </div>
    <!-- /.content -->

</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
