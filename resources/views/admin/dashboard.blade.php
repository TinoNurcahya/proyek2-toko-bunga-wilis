@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<style>
    .stat-card {
        border-radius: 12px;
        padding: 18px 22px;
        border: 2px solid #e3e6f0;
        background: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        transition: 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
    }
    .stat-title {
        font-size: 15px;
        font-weight: 600;
        color: #555;
    }
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        margin-top: -4px;
    }
    .info-box-custom {
        border-radius: 12px;
        border: 1px solid #e3e6f0;
        background: white;
        padding: 20px;
    }
    table th {
        background: #f8f9fc !important;
        font-weight: 600;
    }
</style>


<div class="content-header">
    <div class="container-fluid">
        <h4 class="text-primary font-weight-bold mb-3">Admin Dashboard</h4>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- ROW CARD STATISTIK -->
        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-title">Total Users</div>
                    <div class="stat-value text-primary">{{ $totalUsers ?? 0 }}</div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-title">Total Orders</div>
                    <div class="stat-value text-success">{{ $totalOrders ?? 0 }}</div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-title">Revenue</div>
                    <div class="stat-value text-warning">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

        </div>


        <!-- SECTION: INFORMASI AKUN -->
        <div class="info-box-custom mb-4">
            <h5 class="font-weight-bold">Selamat datang, {{ Auth::user()->name }}!</h5>
            <p class="text-muted mb-1">Anda login sebagai <strong class="text-primary">Administrator</strong></p>

            <hr>

            <div class="row mt-3">
                <div class="col-md-4">
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Role:</strong> 
                        <span class="badge badge-primary">Admin</span>
                    </p>
                </div>
                <div class="col-md-4">
                    <p><strong>Login Method:</strong> Google OAuth</p>
                </div>
            </div>
        </div>


        <!-- TABLE: PESANAN TERBARU -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="font-weight-bold mb-0">Pesanan Terbaru</h5>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th style="width: 70px">ID</th>
                                <th>User</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($latestOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-secondary">{{ $order->status }}</span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted p-3">
                                    Tidak ada pesanan terbaru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>
</section>

@endsection
