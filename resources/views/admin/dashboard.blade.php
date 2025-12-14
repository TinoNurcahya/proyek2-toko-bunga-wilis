@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<!-- ===================== STYLE ===================== -->
<style>
    /* Kartu statistik */
    .stat-card {
        background: #E5E5E5;
        border-radius: 18px;
        padding: 25px;
        text-align: center;z
    }
    .stat-icon {
        font-size: 40px;
        color: #444;
        margin-bottom: 8px;
    }
    .stat-title {
        font-size: 15px;
        font-weight: 600;
        color: #555;
        margin-bottom: 3px;
    }
    .stat-value {
        font-size: 24px;
        font-weight: 800;
        color: #0F184C;
    }

    /* Box chart */
    .chart-box {
        background: #fff;
        border-radius: 22px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Tabel */
    .table thead {
        background: #F5F6FA;
        font-weight: 600;
    }
</style>


<!-- ===================== 4 KOTAK STATISTIK ===================== -->
<div class="row mb-4">

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-seedling"></i></div>
            <div class="stat-title">Jumlah Produk</div>
            <div class="stat-value">{{ $totalProduk }}</div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
            <div class="stat-title">Jumlah Pesanan</div>
            <div class="stat-value">{{ $totalOrders }}</div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-chart-bar"></i></div>
            <div class="stat-title">Penjualan</div>
            <div class="stat-value">Rp {{ number_format($totalRevenue) }}</div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user"></i></div>
            <div class="stat-title">Customers</div>
            <div class="stat-value">{{ $totalCustomer }}</div>
        </div>
    </div>

</div>



<!-- ===================== GRAFIK (LINE) & DONUT ===================== -->
<div class="row mb-4">

    <!-- Grafik Balance History -->
    <div class="col-md-8">
        <div class="chart-box">
            <h5 class="font-weight-bold mb-3">Balance History</h5>
            <canvas id="chartLine" height="170"></canvas>
        </div>
    </div>

    <!-- Donut Chart -->
    <div class="col-md-4">
        <div class="chart-box text-center">
            <h5 class="font-weight-bold mb-3">Kategori Produk Terlaris</h5>
            <canvas id="chartDonut" height="230"></canvas>
        </div>
    </div>

</div>



<!-- ===================== TABEL ORDER ===================== -->
<div class="chart-box">

    <h5 class="font-weight-bold mb-3">Total Order</h5>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Tanaman</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Total Harga</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($latestOrders as $o)
            <tr>
                <td>{{ $o->id }}</td>
                <td>{{ $o->user->name }}</td>
                <td>{{ $o->produk->nama_produk ?? '-' }}</td>
                <td>{{ $o->jumlah }}</td>
                <td>{{ ucfirst($o->status) }}</td>
                <td>Rp {{ number_format($o->total_harga) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>




<!-- ===================== CHART SCRIPT ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ====== LINE CHART ====== */
new Chart(document.getElementById('chartLine'), {
    type: 'line',
    data: {
        labels: ['Jul','Aug','Sep','Oct','Nov','Dec','Jan'],
        datasets: [{
            data: [100,220,350,700,150,420,530],
            borderColor: '#1A73E8',
            backgroundColor: 'rgba(26,115,232,0.2)',
            borderWidth: 3,
            tension: .3,
            fill: true
        }]
    },
    options: {
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true }
        }
    }
});


/* ====== DONUT CHART ====== */
new Chart(document.getElementById('chartDonut'), {
    type: 'doughnut',
    data: {
        labels: ['Mawar', 'Jambu', 'Tulip'],
        datasets: [{
            data: [40, 35, 25],
            backgroundColor: ['#22C55E','#3B82F6','#EF4444'],
            borderWidth: 0
        }]
    },
    options: {
        cutout: '65%',
        maintainAspectRatio: false
    }
});
</script>

@endsection
