@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
  <div class="py-4 mt-5 montserrat">
    <div class="justify-content-center">
      <div class="container">

        <!-- Header Checkout -->
        <div class="d-none d-md-block mb-4 mt-4">
          <div class="d-flex justify-content-between text-center">
            <div class="flex-fill position-relative">
              <div class="step-icon bg-success text-white position-relative z-1">
                <i class="fas fa-shopping-cart fa-fw"></i>
              </div>
              <p class="fw-semibold small mb-0 fraunces">Data pelanggan</p>
              <small class="text-muted montserrat">Langkah 1</small>
            </div>

            <div class="flex-fill position-relative">
              <div class="step-line z-0 bg-success"></div>
              <div class="step-icon bg-success text-white position-relative z-1">
                <i class="fas fa-user-circle fa-fw"></i>
              </div>
              <p class="fw-bold small mb-0 fraunces">Pembayaran</p>
              <small class="text-success montserrat fw-medium">Langkah 2</small>
            </div>

            <div class="flex-fill position-relative">
              <div class="step-line z-0"></div>
              <div class="step-icon bg-warning text-white position-relative z-1">
                <i class="fas fa-check-circle fa-fw"></i>
              </div>
              <p class="fw-semibold small mb-0 fraunces">Konfirmasi Berhasil</p>
              <small class="text-muted montserrat">Langkah 3</small>
            </div>
          </div>
        </div>

        {{-- Mobile Header --}}
        <div class="d-md-none mb-5 mt-3">
          <div class="d-flex align-items-center">
            <a href="{{ route('profile.keranjang') }}" class="btn btn-green text-light btn-md me-3">
              <i class="fas fa-arrow-left"></i>
            </a>
            <div>
              <h5 class="fw-bold mb-0 fraunces">Pembayaran</h5>
              <small class="text-muted montserrat">Langkah <strong>2</strong> dari 3</small>
            </div>
          </div>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <div class="row g-4">
          {{-- RINGKASAN PESANAN --}}
          <div class="col-lg-5">
            <div class="card shadow-sm h-100 border-0">

              <div class="card-header bg-white border-0 py-3">
                <h5 class="fw-bold mb-0 fraunces">
                  <i class="fas fa-receipt me-2"></i>Detail Pesanan
                </h5>
              </div>

              <div class="card-body">

                {{-- Order Info --}}
                <div class="row mb-4">
                  <div class="col-6">
                    <small class="text-muted">Kode Pesanan</small>
                    <h6 class="fw-bold text-primary">{{ $pesanan->kode_pesanan }}</h6>
                  </div>
                  <div class="col-6 text-end">
                    <small class="text-muted">Tanggal</small>
                    <p class="mb-0">{{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                  </div>
                </div>

                <div class="mb-4">
                  <span class="badge bg-warning-subtle text-warning-emphasis border border-warning w-100 py-2">
                    <i class="fas fa-clock me-1"></i>Menunggu Pembayaran
                  </span>
                </div>

                {{-- Items --}}
                <h6 class="fw-semibold mb-3">Items</h6>
                @foreach ($pesanan->items as $item)
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                      <div class="product-thumb me-2">
                        <i class="fas fa-box text-muted"></i>
                      </div>
                      <div>
                        <p class="fw-medium small mb-0">{{ $item->produkUkuran->produk->nama }}</p>
                        <small class="text-muted">Size: {{ $item->produkUkuran->ukuran->nama_ukuran }} ×
                          {{ $item->kuantitas }}</small>
                      </div>
                    </div>
                    <strong>Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}</strong>
                  </div>
                @endforeach

                {{-- Price Breakdown --}}
                <div class="p-3 rounded bg-light mb-4">
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span>Rp {{ number_format($pesanan->subtotal, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Pajak (11%)</span>
                    <span>Rp {{ number_format($pesanan->pajak, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span class="text-muted">Pengiriman</span>
                    <span class="text-success">Gratis</span>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <strong>Total</strong>
                    <strong class="text-success fs-4">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
                  </div>
                </div>

                {{-- Customer Info --}}
                <h6 class="fw-semibold mb-3">Informasi Pelanggan</h6>
                <div class="mb-2">
                  <small class="text-muted">Nama</small>
                  <p class="mb-0 fw-medium">{{ $pesanan->nama_penerima }}</p>
                </div>

                <div class="mb-2">
                  <small class="text-muted">Telepon</small>
                  <p class="mb-0 fw-medium">{{ $pesanan->telepon_penerima }}</p>
                </div>

                <div class="mb-4">
                  <small class="text-muted">Alamat</small>
                  <p class="mb-0 fw-medium">{{ $pesanan->alamat_pengiriman }}</p>
                </div>

                <div class="alert alert-info small">
                  <i class="fas fa-info-circle me-1"></i>
                  Pembayaran berlaku 24 jam setelah pesanan dibuat.
                </div>
              </div>
            </div>
          </div>

          {{-- BAGIAN PEMBAYARAN --}}
          <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">

              <div class="card-header bg-white border-0 py-3">
                <h5 class="fw-bold mb-0 fraunces">
                  <i class="fas fa-credit-card me-2"></i>Metode Pembayaran
                </h5>
              </div>

              <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                  {{-- Midtrans Payment --}}
                  <div id="midtrans-payment" class="mb-4"></div>
                </div>

                {{-- Error Message --}}
                <div id="payment-error" class="alert alert-danger d-none mb-4">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <div>
                      <strong class="d-block">Token pembayaran tidak tersedia</strong>
                      <small class="d-block">Silakan refresh halaman atau hubungi admin</small>
                    </div>
                  </div>
                  <div class="mt-2">
                    <button onclick="location.reload()" class="btn btn-outline-primary btn-sm">
                      <i class="fas fa-redo me-1"></i>Refresh Halaman
                    </button>
                  </div>
                </div>

                <div class="alert alert-warning small">
                  <i class="fas fa-exclamation-circle me-1"></i>
                  <ul class="mb-0 ps-3 mt-2">
                    <li>Jangan tutup halaman sebelum pembayaran selesai</li>
                    <li>Pastikan koneksi internet stabil</li>
                    <li>Simpan bukti pembayaran</li>
                  </ul>
                </div>

                <div class="card bg-light border-0 mt-3">
                  <div class="card-body d-flex flex-column flex-md-row align-items-md-center">
                    <div class="flex-grow-1">
                      <h6 class="fw-semibold mb-1">
                        <i class="fas fa-headset me-1"></i>Butuh Bantuan?
                      </h6>
                      <small class="text-muted">Hubungi CS untuk bantuan pembayaran</small>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-sm mt-3 mt-md-0 p-2">
                      <i class="fab fa-whatsapp me-1"></i> WhatsApp
                    </a>
                  </div>
                </div>

                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                  <a href="{{ route('profile.pesanan') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                  </a>
                  <a href="{{ route('home') }}" class="btn btn-outline-success">
                    <i class="fas fa-home me-1"></i>Beranda
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <!-- Midtrans Snap JS -->
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ $clientKey }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const snapToken = '{{ $snapToken }}';
      const paymentElement = document.getElementById('midtrans-payment');
      const errorElement = document.getElementById('payment-error');

      if (snapToken) {
        // Inisialisasi Midtrans
        window.snap.embed(snapToken, {
          embedId: 'midtrans-payment',
          onSuccess: function(result) {
            console.log('Payment success:', result);
            window.location.href = '{{ route('pembayaran.finish', $pesanan->kode_pesanan) }}';
          },
          onPending: function(result) {
            console.log('Payment pending:', result);
            window.location.href = '{{ route('pembayaran.pending', $pesanan->kode_pesanan) }}';
          },
          onError: function(result) {
            console.log('Payment error:', result);
            window.location.href = '{{ route('pembayaran.error', $pesanan->kode_pesanan) }}';
          },
          onClose: function() {
            console.log('Payment modal closed');
          }
        });
      } else {
        // Jika token tidak ada, tampilkan error
        paymentElement.classList.add('d-none');
        errorElement.classList.remove('d-none');
      }
    });
  </script>
@endpush
