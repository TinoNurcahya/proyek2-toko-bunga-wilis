@extends('layouts.app')

@section('title', 'Pembayaran Tertunda')

@section('content')
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="text-center mb-5">
          <div class="mb-4">
            <div class="rounded-circle bg-warning d-inline-flex align-items-center justify-content-center"
              style="width: 100px; height: 100px;">
              <i class="bi bi-clock-history text-white" style="font-size: 3rem;"></i>
            </div>
          </div>
          <h1 class="fw-bold mb-3">Pembayaran Tertunda</h1>
          <p class="text-muted">Pembayaran Anda sedang diproses</p>
        </div>

        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h5 class="card-title mb-4">Detail Transaksi</h5>

            <div class="row mb-3">
              <div class="col-md-6">
                <p class="mb-1 text-muted">Kode Pesanan</p>
                <h5 class="fw-bold text-primary">{{ $pesanan->kode_pesanan }}</h5>
              </div>
              <div class="col-md-6">
                <p class="mb-1 text-muted">Status</p>
                <span class="badge bg-warning">Menunggu Konfirmasi</span>
              </div>
            </div>

            <div class="mb-3">
              <p class="mb-1 text-muted">Total Pembayaran</p>
              <h4 class="fw-bold text-primary">
                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
              </h4>
            </div>

            <div class="alert alert-info">
              <i class="bi bi-info-circle me-2"></i>
              Pembayaran Anda sedang diproses oleh sistem. Silakan tunggu konfirmasi atau
              hubungi bank/e-wallet Anda untuk informasi lebih lanjut.
            </div>

            <div class="d-grid gap-3 mt-4">
              <a href="{{ route('profile.pesanan') }}" class="btn btn-primary">
                <i class="bi bi-list-check me-2"></i>Lihat Status Pesanan
              </a>
              <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="bi bi-house me-2"></i>Kembali Berbelanja
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
