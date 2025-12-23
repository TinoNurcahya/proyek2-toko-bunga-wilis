
@extends('layouts.admin')


@section('title', 'IoT Dashboard')

@section('content')
  <div class="container-fluid">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1><i class="fas fa-seedling me-2 text-success"></i> Dashboard IoT Tanaman</h1>
      <div class="d-flex align-items-center">
        <span class="badge bg-info me-3" id="lastUpdate">Terakhir update: -</span>
        <button onclick="loadData()" class="btn btn-outline-primary btn-sm">
          <i class="fas fa-sync-alt me-1"></i> Refresh
        </button>
      </div>
    </div>

    <!-- PUMP CONTROL -->
    <div class="card mb-4">
      <div class="card-body text-center">
        <h5><i class="fas fa-tint me-2 text-primary"></i> Kontrol Pompa Air</h5>
        <p class="text-muted mb-3">Kontrol manual pompa penyiraman tanaman</p>

        <div class="row justify-content-center">
          <div class="col-auto">
            <button id="btnPumpOn" class="btn btn-success btn-lg me-2">
              <i class="fas fa-play me-1"></i> Pompa ON
            </button>
            <button id="btnPumpOff" class="btn btn-danger btn-lg">
              <i class="fas fa-stop me-1"></i> Pompa OFF
            </button>
          </div>
        </div>

        <div class="mt-3">
          <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            Durasi default: 5 detik. Sistem otomatis akan mematikan pompa setelah durasi habis.
          </small>
        </div>
      </div>
    </div>

    <!-- STATUS CARDS -->
    <div class="row mb-4">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Suhu
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="currentTemp">
                  {{ $latest->suhu ?? '0' }} °C
                </div>
                <div class="mt-2" id="tempStatus">
                  @php
                    $suhu = $latest->suhu ?? 0;
                    if ($suhu < 20) {
                        $status = 'Terlalu Dingin';
                        $badge = 'warning';
                    } elseif ($suhu > 30) {
                        $status = 'Terlalu Panas';
                        $badge = 'warning';
                    } else {
                        $status = 'Optimal';
                        $badge = 'success';
                    }
                  @endphp
                  <span class="badge bg-{{ $badge }}" id="tempBadge">
                    {{ $status }}
                  </span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-thermometer-half fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Kelembaban Udara
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="currentHumidity">
                  {{ $latest->kelembaban ?? '0' }}%
                </div>
                <div class="mt-2" id="humidityStatus">
                  @php
                    $kelembaban = $latest->kelembaban ?? 0;
                    if ($kelembaban < 40) {
                        $status = 'Terlalu Kering';
                        $badge = 'warning';
                    } elseif ($kelembaban > 80) {
                        $status = 'Terlalu Lembab';
                        $badge = 'warning';
                    } else {
                        $status = 'Optimal';
                        $badge = 'success';
                    }
                  @endphp
                  <span class="badge bg-{{ $badge }}" id="humidityBadge">
                    {{ $status }}
                  </span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-tint fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Kelembaban Tanah
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="currentSoil">
                  {{ $latest->soil ?? '0' }}
                </div>
                <div class="mt-2" id="soilStatus">
                  @php
                    $soil = $latest->soil ?? 0;
                    if ($soil < 1500) {
                        $status = 'Basah';
                        $badge = 'success';
                    } elseif ($soil > 2500) {
                        $status = 'Kering';
                        $badge = 'danger';
                    } else {
                        $status = 'Lembab';
                        $badge = 'success';
                    }
                  @endphp
                  <span class="badge bg-{{ $badge }}" id="soilBadge">
                    {{ $status }}
                  </span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-leaf fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                  Intensitas Cahaya
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="currentLight">
                  {{ $latest->cahaya ?? '0' }} lux
                </div>
                <div class="mt-2" id="lightStatus">
                  @php
                    $cahaya = $latest->cahaya ?? 0;
                    if ($cahaya < 100) {
                        $status = 'Redup';
                        $badge = 'info';
                    } elseif ($cahaya > 1000) {
                        $status = 'Terang';
                        $badge = 'info';
                    } else {
                        $status = 'Cukup';
                        $badge = 'success';
                    }
                  @endphp
                  <span class="badge bg-{{ $badge }}" id="lightBadge">
                    {{ $status }}
                  </span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sun fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MAIN CHART -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
              <i class="fas fa-chart-line me-1"></i> Data Sensor Real-time
            </h6>
            <div class="dropdown">
              <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="timeRangeDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-clock me-1"></i> 24 Jam Terakhir
              </button>
              <ul class="dropdown-menu" aria-labelledby="timeRangeDropdown">
                <li><a class="dropdown-item" href="#" onclick="changeTimeRange(1)">1 Jam Terakhir</a></li>
                <li><a class="dropdown-item" href="#" onclick="changeTimeRange(6)">6 Jam Terakhir</a></li>
                <li><a class="dropdown-item active" href="#" onclick="changeTimeRange(24)">24 Jam Terakhir</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="changeTimeRange(168)">7 Hari Terakhir</a></li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="iotChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MINI CHARTS -->
    <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              <i class="fas fa-thermometer-half me-1"></i> Suhu (°C)
            </h6>
          </div>
          <div class="card-body">
            <canvas id="miniChartSuhu" height="100"></canvas>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">
              <i class="fas fa-tint me-1"></i> Kelembaban (%)
            </h6>
          </div>
          <div class="card-body">
            <canvas id="miniChartKelembaban" height="100"></canvas>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-warning">
              <i class="fas fa-leaf me-1"></i> Kelembaban Tanah
            </h6>
          </div>
          <div class="card-body">
            <canvas id="miniChartSoil" height="100"></canvas>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">
              <i class="fas fa-sun me-1"></i> Cahaya (lux)
            </h6>
          </div>
          <div class="card-body">
            <canvas id="miniChartCahaya" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- DEBUG PANEL (Optional - bisa dihide) -->
    <div class="card mt-4">
      <div class="card-header">
        <h6 class="m-0 font-weight-bold text-secondary">
          <i class="fas fa-bug me-1"></i> System Status
          <button class="btn btn-sm btn-outline-secondary float-end" type="button" data-bs-toggle="collapse"
            data-bs-target="#debugPanel">
            Toggle
          </button>
        </h6>
      </div>
      <div class="collapse" id="debugPanel">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h6>Connection Status</h6>
              <div class="mb-2">
                <span class="me-2">ESP32:</span>
                <span id="esp32Status" class="badge bg-secondary">Checking...</span>
              </div>
              <div class="mb-2">
                <span class="me-2">MQTT Broker:</span>
                <span id="mqttStatus" class="badge bg-secondary">Checking...</span>
              </div>
              <div class="mb-2">
                <span class="me-2">Last MQTT Message:</span>
                <span id="lastMqttTime">-</span>
              </div>
            </div>
            <div class="col-md-6">
              <h6>Quick Test</h6>
              <button class="btn btn-sm btn-outline-primary me-2" onclick="testMqtt()">
                <i class="fas fa-wifi me-1"></i> Test MQTT
              </button>
              <button class="btn btn-sm btn-outline-info" onclick="showSystemInfo()">
                <i class="fas fa-info-circle me-1"></i> System Info
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
  </div>
@endsection

@section('styles')
  <style>
    .card {
      border-radius: 10px;
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .border-left-primary {
      border-left: 4px solid #4e73df !important;
    }

    .border-left-success {
      border-left: 4px solid #1cc88a !important;
    }

    .border-left-warning {
      border-left: 4px solid #f6c23e !important;
    }

    .border-left-info {
      border-left: 4px solid #36b9cc !important;
    }

    .chart-area {
      position: relative;
      height: 400px;
      width: 100%;
    }

    @media (max-width: 768px) {
      .chart-area {
        height: 300px;
      }
    }

    #lastUpdate {
      font-size: 0.85rem;
    }

    /* Animation for pump button */
    .pump-active {
      animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }

      100% {
        transform: scale(1);
      }
    }
  </style>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // ==================== GLOBAL VARIABLES ====================
  let mainChart = null;
  let miniCharts = {};
  let timeRange = 24;
  let pumpActive = false;
  let lastMqttTime = null;
  let chartsInitialized = false;

  // ==================== HELPER FUNCTIONS ====================
  function getCsrfToken() {
    // Coba dari meta tag
    let token = document.querySelector('meta[name="csrf-token"]')?.content;

    if (!token) {
      // Coba dari input hidden
      token = document.getElementById('csrf_token')?.value;
    }

    if (!token) {
      // Coba dari cookie
      const cookies = document.cookie.split(';');
      for (let cookie of cookies) {
        const [name, value] = cookie.trim().split('=');
        if (name === 'XSRF-TOKEN') {
          token = decodeURIComponent(value);
          break;
        }
      }
    }

    console.log('CSRF Token found:', token ? 'YES' : 'NO');
    return token || '';
  }

  function showAlert(message, type = 'info') {
    const icon = type === 'error' ? '❌' : type === 'success' ? '✅' : 'ℹ️';
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
      ${icon} ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
      if (alertDiv.parentNode) {
        alertDiv.remove();
      }
    }, 5000);
  }

  // ==================== INITIALIZATION ====================
  function initCharts() {
    console.log('Initializing charts...');

    try {
      // Main Chart
      const mainCtx = document.getElementById('iotChart');
      if (!mainCtx) {
        console.error('Main chart canvas not found!');
        return false;
      }

      mainChart = new Chart(mainCtx, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
              label: 'Suhu (°C)',
              data: [],
              borderColor: '#4e73df',
              backgroundColor: 'rgba(78, 115, 223, 0.1)',
              borderWidth: 2,
              tension: 0.4,
              fill: true
            },
            {
              label: 'Kelembaban (%)',
              data: [],
              borderColor: '#1cc88a',
              backgroundColor: 'rgba(28, 200, 138, 0.1)',
              borderWidth: 2,
              tension: 0.4,
              fill: true
            },
            {
              label: 'Kelembaban Tanah',
              data: [],
              borderColor: '#f6c23e',
              backgroundColor: 'rgba(246, 194, 62, 0.1)',
              borderWidth: 2,
              tension: 0.4,
              fill: true
            },
            {
              label: 'Cahaya (lux)',
              data: [],
              borderColor: '#36b9cc',
              backgroundColor: 'rgba(54, 185, 204, 0.1)',
              borderWidth: 2,
              tension: 0.4,
              fill: true
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          interaction: {
            intersect: false,
            mode: 'index'
          },
          scales: {
            x: {
              title: {
                display: true,
                text: 'Waktu'
              },
              ticks: {
                maxTicksLimit: 10
              }
            },
            y: {
              beginAtZero: false,
              title: {
                display: true,
                text: 'Nilai Sensor'
              }
            }
          },
          plugins: {
            tooltip: {
              mode: 'index',
              intersect: false,
              callbacks: {
                title: function(context) {
                  return context[0].label;
                }
              }
            },
            legend: {
              position: 'top',
            }
          }
        }
      });

      // Mini Charts
      const miniConfigs = [{
          id: 'miniChartSuhu',
          color: '#4e73df',
          label: 'Suhu'
        },
        {
          id: 'miniChartKelembaban',
          color: '#1cc88a',
          label: 'Kelembaban'
        },
        {
          id: 'miniChartSoil',
          color: '#f6c23e',
          label: 'Soil'
        },
        {
          id: 'miniChartCahaya',
          color: '#36b9cc',
          label: 'Cahaya'
        }
      ];

      miniConfigs.forEach(config => {
        const ctx = document.getElementById(config.id);
        if (!ctx) {
          console.error(`Mini chart ${config.id} not found!`);
          return;
        }

        miniCharts[config.id] = new Chart(ctx, {
          type: 'line',
          data: {
            labels: [],
            datasets: [{
              label: config.label,
              data: [],
              borderColor: config.color,
              backgroundColor: config.color + '20',
              borderWidth: 1,
              tension: 0.4,
              fill: true
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false
              }
            },
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              point: {
                radius: 0
              }
            }
          }
        });
      });

      chartsInitialized = true;
      console.log('Charts initialized successfully');
      return true;

    } catch (error) {
      console.error('Error initializing charts:', error);
      showAlert('Gagal memuat grafik: ' + error.message, 'error');
      return false;
    }
  }

  // ==================== DATA FUNCTIONS ====================
  async function loadData() {
    console.log(`Loading data for ${timeRange} hours...`);

    const btn = document.querySelector('#btnRefreshData') || document.querySelector('button[onclick*="loadData"]');
    const originalText = btn ? btn.innerHTML : 'Refresh Data';

    if (btn) {
      btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Loading...';
      btn.disabled = true;
    }

    try {
      const response = await fetch(`/admin/iot/data?hours=${timeRange}`);

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();
      console.log(`Data loaded: ${data.length} records`);

      if (data.length > 0) {
        updateCharts(data);
        updateStatusCards(data[data.length - 1]);
        updateLastUpdate();
        updateSystemStatus(true);
      } else {
        console.warn('No data available');
        showAlert('⚠️ Tidak ada data sensor tersedia', 'warning');
        updateSystemStatus(false);
      }
    } catch (error) {
      console.error('Error loading data:', error);
      showAlert('❌ Gagal memuat data: ' + error.message, 'error');
      updateSystemStatus(false);
    } finally {
      if (btn) {
        btn.innerHTML = originalText;
        btn.disabled = false;
      }
    }
  }

  function updateCharts(data) {
    if (!data || data.length === 0) {
      console.warn('No data to update charts');
      return;
    }

    if (!mainChart || !chartsInitialized) {
      console.warn('Charts not initialized yet');
      return;
    }

    try {
      // Format labels (jam:menit)
      const labels = data.map(item => {
        const date = new Date(item.created_at);
        return date.toLocaleTimeString('id-ID', {
          hour: '2-digit',
          minute: '2-digit'
        });
      });

      // Update main chart
      mainChart.data.labels = labels;
      mainChart.data.datasets[0].data = data.map(d => d.suhu || 0);
      mainChart.data.datasets[1].data = data.map(d => d.kelembaban || 0);
      mainChart.data.datasets[2].data = data.map(d => d.soil || 0);
      mainChart.data.datasets[3].data = data.map(d => d.cahaya || 0);
      mainChart.update();

      // Update mini charts (last 10 points)
      const recentData = data.slice(-10);
      const recentLabels = recentData.map(d => {
        const date = new Date(d.created_at);
        return date.toLocaleTimeString('id-ID', {
          hour: '2-digit',
          minute: '2-digit'
        });
      });

      // Update each mini chart
      if (miniCharts.miniChartSuhu) {
        miniCharts.miniChartSuhu.data.labels = recentLabels;
        miniCharts.miniChartSuhu.data.datasets[0].data = recentData.map(d => d.suhu || 0);
        miniCharts.miniChartSuhu.update();
      }

      if (miniCharts.miniChartKelembaban) {
        miniCharts.miniChartKelembaban.data.labels = recentLabels;
        miniCharts.miniChartKelembaban.data.datasets[0].data = recentData.map(d => d.kelembaban || 0);
        miniCharts.miniChartKelembaban.update();
      }

      if (miniCharts.miniChartSoil) {
        miniCharts.miniChartSoil.data.labels = recentLabels;
        miniCharts.miniChartSoil.data.datasets[0].data = recentData.map(d => d.soil || 0);
        miniCharts.miniChartSoil.update();
      }

      if (miniCharts.miniChartCahaya) {
        miniCharts.miniChartCahaya.data.labels = recentLabels;
        miniCharts.miniChartCahaya.data.datasets[0].data = recentData.map(d => d.cahaya || 0);
        miniCharts.miniChartCahaya.update();
      }

      console.log('Charts updated successfully');
    } catch (error) {
      console.error('Error updating charts:', error);
      showAlert('❌ Error update grafik: ' + error.message, 'error');
    }
  }

  function updateStatusCards(latestData) {
    if (!latestData) return;

    try {
      // Update temperature
      const tempEl = document.getElementById('currentTemp');
      const humidityEl = document.getElementById('currentHumidity');
      const soilEl = document.getElementById('currentSoil');
      const lightEl = document.getElementById('currentLight');

      if (tempEl) tempEl.textContent = (latestData.suhu || 0).toFixed(1) + ' °C';
      if (humidityEl) humidityEl.textContent = (latestData.kelembaban || 0).toFixed(1) + '%';
      if (soilEl) soilEl.textContent = latestData.soil || 0;
      if (lightEl) lightEl.textContent = (latestData.cahaya || 0).toFixed(0) + ' lux';

      updateBadge('temp', latestData.suhu);
      updateBadge('humidity', latestData.kelembaban);
      updateBadge('soil', latestData.soil);
      updateBadge('light', latestData.cahaya);
    } catch (error) {
      console.error('Error updating status cards:', error);
    }
  }

  function updateBadge(type, value) {
    const badgeId = type + 'Badge';
    let status = '';
    let badgeClass = 'secondary';

    if (value === undefined || value === null) return;

    const badge = document.getElementById(badgeId);
    if (!badge) return;

    switch (type) {
      case 'temp':
        if (value < 20) {
          status = 'Terlalu Dingin';
          badgeClass = 'warning';
        } else if (value > 30) {
          status = 'Terlalu Panas';
          badgeClass = 'warning';
        } else {
          status = 'Optimal';
          badgeClass = 'success';
        }
        break;

      case 'humidity':
        if (value < 40) {
          status = 'Terlalu Kering';
          badgeClass = 'warning';
        } else if (value > 80) {
          status = 'Terlalu Lembab';
          badgeClass = 'warning';
        } else {
          status = 'Optimal';
          badgeClass = 'success';
        }
        break;

      case 'soil':
        if (value < 1500) {
          status = 'Basah';
          badgeClass = 'success';
        } else if (value > 2500) {
          status = 'Kering';
          badgeClass = 'danger';
        } else {
          status = 'Lembab';
          badgeClass = 'success';
        }
        break;

      case 'light':
        if (value < 100) {
          status = 'Redup';
          badgeClass = 'info';
        } else if (value > 1000) {
          status = 'Terang';
          badgeClass = 'info';
        } else {
          status = 'Cukup';
          badgeClass = 'success';
        }
        break;
    }

    badge.className = 'badge bg-' + badgeClass;
    badge.textContent = status;
  }

  // ==================== PUMP CONTROL ====================
  async function pumpOn() {
    console.log('=== PUMP ON REQUEST ===');

    if (pumpActive) {
      showAlert('⚠️ Pompa sedang aktif, tunggu sebentar', 'warning');
      return;
    }

    const duration = prompt('Durasi pompa (detik, 1-60):', '5');
    if (!duration || isNaN(duration) || duration < 1 || duration > 60) {
      showAlert('❌ Durasi harus antara 1-60 detik', 'error');
      return;
    }

    // Get CSRF token using helper function
    const csrfToken = getCsrfToken();
    if (!csrfToken) {
      showAlert('❌ CSRF Token tidak ditemukan! Refresh halaman.', 'error');
      window.location.reload();
      return;
    }

    // Visual feedback
    const pumpBtn = document.getElementById('btnPumpOn');
    const originalText = pumpBtn ? pumpBtn.innerHTML : 'Pompa ON';
    const originalClass = pumpBtn ? pumpBtn.className : '';

    if (pumpBtn) {
      pumpBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';
      pumpBtn.className = 'btn btn-warning btn-lg me-2';
      pumpBtn.disabled = true;
    }

    try {
      console.log(`Sending pump ON for ${duration} seconds`);

      // Gunakan FormData
      const formData = new FormData();
      formData.append('_token', csrfToken);
      formData.append('action', 'ON');
      formData.append('duration', duration);

      const response = await fetch('/admin/iot/pump', {
        method: 'POST',
        body: formData,
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      console.log('Response status:', response.status, response.statusText);

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();
      console.log('Pump response:', data);

      if (data.status === 'success') {
        pumpActive = true;

        // Visual effect
        if (pumpBtn) {
          pumpBtn.innerHTML = '<i class="fas fa-play me-1"></i> Pompa AKTIF';
          pumpBtn.className = 'btn btn-success btn-lg me-2 pulse-animation';
          pumpBtn.disabled = false;
        }

        showAlert('✅ ' + data.message, 'success');

        console.log('MQTT Details:', data.mqtt);

        // Auto reset after duration
        setTimeout(() => {
          pumpActive = false;
          if (pumpBtn) {
            pumpBtn.innerHTML = '<i class="fas fa-play me-1"></i> Pompa ON';
            pumpBtn.className = originalClass;
            pumpBtn.classList.remove('pulse-animation');
          }
          showAlert('⏰ Durasi pompa selesai', 'info');
        }, duration * 1000);
      } else {
        showAlert('❌ ' + (data.message || 'Gagal mengaktifkan pompa'), 'error');
      }

    } catch (error) {
      console.error('Pump ON error:', error);
      showAlert('❌ Error: ' + error.message, 'error');
    } finally {
      if (pumpBtn && !pumpActive) {
        pumpBtn.innerHTML = originalText;
        pumpBtn.className = originalClass;
        pumpBtn.disabled = false;
      }
    }
  }

  async function pumpOff() {
    console.log('=== PUMP OFF REQUEST ===');

    if (!pumpActive) {
      showAlert('ℹ️ Pompa tidak sedang aktif', 'info');
      return;
    }

    const csrfToken = getCsrfToken();
    if (!csrfToken) {
      showAlert('❌ CSRF Token tidak ditemukan! Refresh halaman.', 'error');
      window.location.reload();
      return;
    }

    const pumpBtn = document.getElementById('btnPumpOn');
    const pumpOffBtn = document.getElementById('btnPumpOff');
    const originalText = pumpOffBtn ? pumpOffBtn.innerHTML : 'Pompa OFF';

    if (pumpOffBtn) {
      pumpOffBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mematikan...';
      pumpOffBtn.disabled = true;
    }

    try {
      const formData = new FormData();
      formData.append('_token', csrfToken);
      formData.append('action', 'OFF');

      const response = await fetch('/admin/iot/pump', {
        method: 'POST',
        body: formData,
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();
      
      if (data.status === 'success') {
        pumpActive = false;
        
        // Reset button appearance
        if (pumpBtn) {
          pumpBtn.innerHTML = '<i class="fas fa-play me-1"></i> Pompa ON';
          pumpBtn.className = 'btn btn-success btn-lg me-2';
          pumpBtn.classList.remove('pulse-animation');
        }
        
        showAlert('✅ Pompa berhasil dimatikan', 'success');
      } else {
        showAlert('❌ ' + (data.message || 'Gagal mematikan pompa'), 'error');
      }
    } catch (error) {
      console.error('Pump OFF error:', error);
      showAlert('❌ Error: ' + error.message, 'error');
    } finally {
      if (pumpOffBtn) {
        pumpOffBtn.innerHTML = originalText;
        pumpOffBtn.disabled = false;
      }
    }
  }

  // ==================== HELPER FUNCTIONS ====================
  function updateLastUpdate() {
    const now = new Date();
    const timeStr = now.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit'
    });

    const element = document.getElementById('lastUpdate');
    if (element) {
      element.textContent = `Terakhir update: ${timeStr}`;
    }
  }

  function changeTimeRange(hours) {
    timeRange = hours;

    // Update dropdown text
    const dropdown = document.getElementById('timeRangeDropdown');
    const textMap = {
      1: '1 Jam Terakhir',
      6: '6 Jam Terakhir',
      24: '24 Jam Terakhir',
      168: '7 Hari Terakhir'
    };

    if (dropdown) {
      dropdown.innerHTML = `<i class="fas fa-clock me-1"></i> ${textMap[hours] || '24 Jam Terakhir'}`;
    }

    // Update active class
    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.classList.remove('active');
      const match = item.getAttribute('onclick')?.match(/\d+/);
      if (match && parseInt(match[0]) === hours) {
        item.classList.add('active');
      }
    });

    loadData();
  }

  function updateSystemStatus(connected) {
    const esp32Status = document.getElementById('esp32Status');
    const mqttStatus = document.getElementById('mqttStatus');

    if (connected) {
      if (esp32Status) {
        esp32Status.className = 'badge bg-success';
        esp32Status.textContent = 'Online';
      }
      if (mqttStatus) {
        mqttStatus.className = 'badge bg-success';
        mqttStatus.textContent = 'Connected';
      }
    } else {
      if (esp32Status) {
        esp32Status.className = 'badge bg-danger';
        esp32Status.textContent = 'Offline';
      }
      if (mqttStatus) {
        mqttStatus.className = 'badge bg-danger';
        mqttStatus.textContent = 'Disconnected';
      }
    }
  }

  async function testMqtt() {
    showAlert('Testing MQTT connection...', 'info');

    try {
      const response = await fetch('/admin/iot/data?hours=1');
      const data = await response.json();

      if (data && data.length > 0) {
        const latest = data[data.length - 1];
        const timeDiff = Date.now() - new Date(latest.created_at).getTime();
        const secondsAgo = Math.floor(timeDiff / 1000);

        showAlert(`✅ ESP32 online. Data terakhir ${secondsAgo} detik yang lalu`, 'success');
        updateSystemStatus(true);
      } else {
        showAlert('⚠️ Tidak ada data dari ESP32', 'warning');
        updateSystemStatus(false);
      }
    } catch (error) {
      showAlert('❌ Error testing MQTT: ' + error.message, 'error');
      updateSystemStatus(false);
    }
  }

  // ==================== EVENT LISTENERS ====================
  function attachEventListeners() {
    console.log('Attaching event listeners...');

    // Button elements
    const elements = [{
        id: 'btnPumpOn',
        func: pumpOn
      },
      {
        id: 'btnPumpOff',
        func: pumpOff
      }
    ];

    // Add ID to refresh button if exists
    const refreshBtn = document.querySelector('button[onclick*="loadData"]');
    if (refreshBtn && !refreshBtn.id) {
      refreshBtn.id = 'btnRefreshData';
      elements.push({
        id: 'btnRefreshData',
        func: loadData
      });
    }

    elements.forEach(item => {
      const element = document.getElementById(item.id);
      if (element) {
        // Remove any existing onclick
        element.removeAttribute('onclick');
        
        // Remove existing listeners by cloning
        const newElement = element.cloneNode(true);
        element.parentNode.replaceChild(newElement, element);
        
        // Add new listener
        newElement.addEventListener('click', item.func);
        console.log(`Event listener attached to: ${item.id}`);
      }
    });

    // Dropdown items
    document.querySelectorAll('.dropdown-item[onclick*="changeTimeRange"]').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const match = this.getAttribute('onclick')?.match(/\d+/);
        if (match) {
          changeTimeRange(parseInt(match[0]));
        }
      });
    });
  }

  // ==================== INITIALIZATION ====================
  document.addEventListener('DOMContentLoaded', function() {
    console.log('IoT Dashboard Initializing...');

    // Initialize charts first
    const chartsReady = initCharts();

    if (!chartsReady) {
      console.error('Failed to initialize charts');
      showAlert('Gagal memuat grafik. Refresh halaman.', 'error');
      return;
    }

    // Attach event listeners
    attachEventListeners();

    // Load initial data after charts are ready
    setTimeout(() => {
      loadData();
    }, 500);

    // Auto-refresh every 30 seconds
    setInterval(loadData, 30000);

    // Initial system check
    setTimeout(testMqtt, 2000);

    console.log('IoT Dashboard Initialized!');
  });

  // Make functions globally available
  window.loadData = loadData;
  window.pumpOn = pumpOn;
  window.pumpOff = pumpOff;
  window.changeTimeRange = changeTimeRange;
  window.testMqtt = testMqtt;
</script>

<style>
  .pulse-animation {
    animation: pulse 2s infinite;
  }
  
  @keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    70% {
      box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
    }
    100% {
      box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
    }
  }
</style>