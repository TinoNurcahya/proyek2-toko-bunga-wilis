@extends('layouts.app')

@section('title', 'Pembayaran Gagal')

@section('content')
  <div class="py-4 mt-5 montserrat">
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
            <div class="step-line z-0 bg-danger"></div>
            <div class="step-icon bg-danger text-white position-relative z-1">
              <i class="fa-solid fa-xmark-circle fa-fw"></i>
            </div>
            <p class="fw-bold small mb-0 fraunces">Pembayaran Gagal</p>
            <small class="text-danger montserrat fw-medium">Langkah 3</small>
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
            <h5 class="fw-bold mb-0 fraunces">Pembayaran Gagal</h5>
            <small class="text-muted montserrat">Langkah <strong>3</strong> dari 3</small>
          </div>
        </div>
      </div>

      <!-- Konten Utama -->
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="text-center mb-5">
            <div class="mb-4">
              <div class="rounded-circle bg-danger d-inline-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px;">
                <i class="fa-solid fa-xmark text-white" style="font-size: 3rem;"></i>
              </div>
            </div>
            <h1 class="fw-bold mb-3 fraunces">Pembayaran Gagal</h1>
            <p class="text-muted">Terjadi kesalahan saat memproses pembayaran</p>
          </div>

          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <h5 class="card-title mb-4 fraunces">
                <i class="fas fa-file-invoice me-2"></i>Detail Transaksi
              </h5>

              <div class="row mb-3">
                <div class="col-md-6">
                  <p class="mb-1 fw-bold">Kode Pesanan</p>
                  <h5 class="fw-bold text-danger">{{ $pesanan->kode_pesanan }}</h5>
                </div>
                <div class="col-md-6">
                  <p class="mb-1 fw-bold">Status</p>
                  <span class="badge bg-danger">Gagal</span>
                </div>
              </div>

              <div class="mb-3">
                <p class="mb-1 fw-bold">Tanggal</p>
                <p>{{ $pesanan->created_at->format('d F Y H:i') }}</p>
              </div>

              <div class="mb-3">
                <p class="mb-1 fw-bold">Metode Pembayaran</p>
                <p class="fw-medium">{{ ucfirst(str_replace('_', ' ', $pesanan->metode_pembayaran)) }}</p>
              </div>

              <div class="mb-3">
                <p class="mb-1 fw-bold">Total Pembayaran</p>
                <h4 class="fw-bold text-danger">
                  Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                </h4>
              </div>

              <hr>

              <div class="alert alert-danger mt-4">
                <i class="fa fa-exclamation-triangle me-2"></i>
                Pembayaran Anda gagal diproses. Silakan coba lagi atau gunakan metode pembayaran lain.
              </div>

              <div class="d-grid gap-3 mt-4 text-light">
                <a href="{{ route('pembayaran.midtrans', $pesanan->kode_pesanan) }}" class="btn btn-green btn-md">
                  <i class="fa fa-credit-card me-2"></i>Coba Lagi
                </a>
                <a href="{{ route('profile.keranjang') }}" class="btn btn-outline-success">
                  <i class="fa fa-cart-shopping me-2"></i>Kembali ke Keranjang
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                  <i class="fa fa-house me-2"></i>Kembali Berbelanja
                </a>
              </div>
            </div>
          </div>

          <div class="text-center mt-4">
            <p class="text-muted small">
              Masih mengalami masalah?
              <a href="https://wa.me/6281234567890" target="_blank"
                class="btn btn-green btn-sm mt-3 mt-md-0 p-2 text-light">
                <i class="fab fa-whatsapp me-1"></i> WhatsApp
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
