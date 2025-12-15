@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Dashboard Admin</h1>

    <!-- CARD SELAMAT DATANG -->
    <div class="card mb-4">
        <div class="card-body">
            <h4>Selamat datang, Admin!</h4>
            <p>Ini adalah halaman dashboard toko bunga.</p>
        </div>
    </div>

    <!-- STATISTIK DASHBOARD -->
    <div class="row">

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-leaf fa-2x text-success mb-2"></i>
                    <p class="mb-1">Jumlah Produk</p>
                    <h4>{{ $totalProduk }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-2x text-primary mb-2"></i>
                    <p class="mb-1">Jumlah Pesanan</p>
                    <h4>{{ $totalPesanan }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-2x text-warning mb-2"></i>
                    <p class="mb-1">Total Penjualan</p>
                    <h4>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-users fa-2x text-danger mb-2"></i>
                    <p class="mb-1">Jumlah Customer</p>
                    <h4>{{ $totalCustomer }}</h4>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== TAMBAHAN FITUR ===== -->
    <div class="row mt-4">

        <!-- GRAFIK PENJUALAN -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <strong>Statistik Penjualan Tanaman</strong>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- PRODUK TERLARIS (TABEL) -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <strong>Produk Terlaris</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Tanaman</th>
                                <th>Terjual</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->total_terjual }}</td>
                                <td>
                                    @if ($item->total_terjual >= 100)
                                        <span class="badge bg-success">Best Seller</span>
                                    @elseif ($item->total_terjual >= 50)
                                        <span class="badge bg-primary">Populer</span>
                                    @else
                                        <span class="badge bg-warning">Baru</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    Belum ada data penjualan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== DONUT PRODUK TERLARIS ===== -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <strong>Diagram Produk Terlaris</strong>
                </div>
                <div class="card-body">
                    <div style="width: 220px; height: 220px; margin: auto;">
                        <canvas id="donutProdukTerlaris"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- SCRIPT CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- LINE CHART -->
<script>
fetch("{{ route('admin.dashboard.chartData') }}")
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: data.data,
                    fill: true,
                    tension: 0.4,
                }]
            }
        });
    });
</script>

<!-- DONUT PRODUK TERLARIS -->
<script>
fetch("{{ route('admin.dashboard.produkTerlaris') }}")
    .then(response => response.json())
    .then(data => {

        const labels = data.map(item => item.nama);
        const values = data.map(item => item.total_terjual);

        const ctx = document.getElementById('donutProdukTerlaris').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
