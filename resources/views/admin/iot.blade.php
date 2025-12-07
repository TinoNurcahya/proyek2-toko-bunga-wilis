@extends('admin.layout')

@section('title', 'IoT Monitoring')

@section('content')

<style>
    .iot-card {
        background: #eeeeee;
        border-radius: 22px;
        padding: 28px;
        text-align: center;
        margin-bottom: 20px;
    }

    .iot-title {
        font-size: 16px;
        font-weight: 600;
        color: #4a4a4a;
    }

    .iot-value {
        font-size: 28px;
        font-weight: 800;
        color: #0F184C;
        margin-top: 5px;
    }

    .manual-box {
        background: #ffffff;
        border-radius: 22px;
        padding: 25px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    .manual-box h4 {
        font-weight: 800;
        font-size: 22px;
    }

    .btn-iot {
        background: #4CAF50;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
    }

    .btn-iot:hover {
        background: #45A049;
        color: white;
    }
</style>

<h2 class="page-title mb-4">IoT Monitoring</h2>

<div class="row">

    <!-- IOT BOX -->
    <div class="col-md-4">
        <div class="iot-card">
            <div class="iot-title">Suhu Ruangan</div>
            <div class="iot-value">25.5°</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="iot-card">
            <div class="iot-title">Kelembapan Udara</div>
            <div class="iot-value">85%</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="iot-card">
            <div class="iot-title">Kelembapan Tanah</div>
            <div class="iot-value">85%</div>
        </div>
    </div>

</div>

<!-- GRAFIK LINE -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <canvas id="iotChart" height="140"></canvas>
    </div>
</div>


<!-- MANUAL CONTROL -->
<div class="manual-box">
    <h4>KONTROL MANUAL</h4>

    <button class="btn-iot mt-3">Siram Sekarang (Tempat A)</button> <br><br>

    <button class="btn-iot">Siram Sekarang (Tempat B)</button>
</div>


<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('iotChart'), {
    type: 'line',
    data: {
        labels: ['08:00','09:00','10:00','11:00','12:00','14:00'],
        datasets: [
            {
                label: 'Suhu',
                borderColor: 'red',
                data: [20,22,21,23,24,22],
                tension: .4,
            },
            {
                label: 'Kelembapan',
                borderColor: 'blue',
                data: [40,45,42,47,50,44],
                tension: .4,
            },
            {
                label: 'Cahaya',
                borderColor: 'green',
                data: [60,65,70,75,80,76],
                tension: .4,
            }
        ]
    }
});
</script>

@endsection
