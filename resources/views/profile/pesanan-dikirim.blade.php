@extends('layouts.app')

@section('title', 'Pesanan Dikirim')

@section('content')
  <section>
    <div class="py-4 mt-5">
      <div class="container montserrat">
        <div class="row g-4">
          <!-- Sidebar -->
          <div class="col-md-3">
            @include('profile.partials.sidebar')
          </div>

          <!-- Konten Pesanan Dikirim -->
          <div class="col-md-9">
            <div class="card shadow-sm">
              <div class="card-body">
                <h2 class="h5 fw-bold text-dark mb-1">Pesanan Dikirim</h2>
                <p class="small text-muted mb-0">Pesanan yang sedang dalam pengiriman.</p>

                @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
                @endif

                @forelse($orders as $order)
                  <div class="card mb-4 border">
                    <div
                      class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center bg-light gap-1">
                      <div>
                        <span class="mb-1 d-block">Order #{{ $order->kode_pesanan }}</span>
                        <small class="text-muted">
                          Dikirim pada tanggal
                          {{ \Carbon\Carbon::parse($order->updated_at)->locale('id')->translatedFormat('d F Y') }}
                        </small>
                      </div>

                      {{-- Status Dikirim --}}
                      <div>
                        <span class="badge bg-info">Dikirim</span>
                      </div>
                    </div>

                    <!-- Item Pesanan -->
                    <div class="card-body p-0 overflow-x-hidden overflow-y-auto" style="max-height: 250px;">
                      @foreach ($order->items as $item)
                        <div class="row align-items-center py-2 px-3">
                          <div class="col-12 col-md-8 mb-2 mb-md-0">
                            <h6 class="fw-semibold mb-1">{{ $item->produkUkuran->produk->nama ?? 'Produk' }}</h6>
                            <div class="text-muted small mb-1">
                              Ukuran: {{ $item->produkUkuran->ukuran->nama_ukuran ?? 'Standar' }}
                              • Qty: {{ $item->kuantitas }}
                            </div>
                          </div>

                          <div class="col-12 col-md-4 text-start text-md-end">
                            <div class="fw-semibold mb-1">
                              Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}
                            </div>
                            <small class="text-muted">
                              @ Rp {{ number_format($item->harga_satuan, 0, ',', '.') }} / item
                            </small>
                          </div>
                        </div>
                      @endforeach
                    </div>

                    <!-- Footer Pesanan -->
                    <div class="card-footer bg-light p-3 overflow-x-hidden overflow-y-auto" style="max-height: 450px;">
                      <div class="d-flex flex-column gap-3">
                        <div class="d-flex flex-column flex-md-row gap-3">
                          <!-- Informasi Pengiriman -->
                          <div class="flex-grow-1">
                            <div class="bg-white p-3 rounded border h-100">
                              <h6 class="fw-semibold mb-2">
                                <i class="fa-solid fa-truck text-primary me-2"></i>
                                Informasi Pengiriman
                              </h6>

                              @if ($order->alamat_pengiriman)
                                <div class="mb-3">
                                  <div class="small text-muted mb-1">Alamat Tujuan:</div>
                                  <p class="mb-1 small">{{ $order->alamat_pengiriman }}</p>
                                </div>
                              @endif
                            </div>
                          </div>

                          <!-- Metode Pembayaran -->
                          <div class="flex-grow-1">
                            <div class="bg-white p-3 rounded border h-100">
                              <h6 class="fw-semibold mb-2">Metode Pembayaran</h6>
                              @if ($order->metode_pembayaran === 'bank_transfer')
                                <div class="d-flex align-items-start">
                                  <i class="fa-solid fa-building-columns text-primary fs-6 me-2"></i>
                                  <div>
                                    <div class="fw-semibold small">
                                      Transfer Bank ({{ strtoupper($order->bank) }})
                                    </div>
                                    <small class="text-muted">Metode pembayaran</small>
                                  </div>
                                </div>
                              @else
                                <div class="d-flex align-items-start">
                                  <i class="fa-solid fa-wallet text-primary fs-6 me-2"></i>
                                  <div>
                                    <div class="fw-semibold small">{{ ucfirst($order->metode_pembayaran) }}</div>
                                    <small class="text-muted">Metode pembayaran dipilih</small>
                                  </div>
                                </div>
                              @endif
                            </div>
                          </div>
                        </div>

                        <!-- Rincian Biaya -->
                        <div class="bg-white p-3 rounded border">
                          <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-semibold mb-0">Rincian Biaya</h6>
                            <span class="fw-bold h5 text-primary mb-0">
                              Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Tombol Aksi untuk Pesanan Dikirim -->
                    <div class="card-footer bg-white">
                      <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-2">

                        <!-- Tombol Konfirmasi Diterima -->
                        <form action="{{ route('pesanan.selesaikan', ['kode' => $order->kode_pesanan]) }}" method="POST"
                          class="d-inline">
                          @csrf
                          @method('POST')
                          <button type="submit" class="btn btn-green text-light"
                            onclick="return confirm('Konfirmasi pesanan telah diterima?')">
                            <i class="fa-solid fa-check-circle me-2"></i> Konfirmasi Diterima
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                @empty
                  <!-- Jika Tidak Ada Pesanan Dikirim -->
                  <div class="text-center py-5">
                    <div class="mb-4">
                      <div class="display-1 text-muted">
                        <i class="fa-solid fa-truck"></i>
                      </div>
                    </div>
                    <h3 class="fw-bold mb-3">Belum Ada Pesanan Dikirim</h3>
                    <p class="text-muted mb-4">Tidak ada pesanan yang sedang dalam pengiriman</p>
                    <a href="{{ route('profile.pesanan') }}" class="btn btn-outline-primary px-4">
                      <i class="fa-solid fa-list me-2"></i> Lihat Semua Pesanan
                    </a>
                  </div>
                @endforelse

                {{-- Pagination --}}
                @if ($orders->hasPages())
                  <div class="mt-4">
                    <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center">
                        {{ $orders->links('pagination::bootstrap-5') }}
                      </ul>
                    </nav>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
