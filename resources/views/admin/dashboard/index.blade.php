@extends('admin.layouts.admin')

@section('content')
<div class="container py-4">
    <!-- CARD SELAMAT DATANG -->
    <div class="card mb-4">
        <div class="card-body">
            <h4>Selamat datang,{{ Auth::user()->nama ??'Admin'}}Admin!</h4>
            <p>Semangat mengelola Willis Garden hari ini.</p>
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

    <!-- STATISTIK PENJUALAN -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header py-2">
                <strong>Statistik Penjualan Tanaman</strong>
            </div>
            <div class="card-body p-2" style="height:260px">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- PRODUK TERLARIS -->
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-header py-2">
                <strong>Produk Terlaris</strong>
            </div>
            <div class="card-body p-0" style="height:260px; overflow:auto">
                <table class="table table-sm mb-0 text-center">
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
                                <span class="badge bg-warning">Baru</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-muted">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DONUT -->
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-header py-2 text-center">
                <strong>Diagram Produk Terlaris</strong>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center"
                 style="height:260px">
                <canvas id="donutProdukTerlaris" width="180" height="180"></canvas>
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
