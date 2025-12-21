@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
  <section>
    <div class="py-4 mt-5">
      <div class="container montserrat">
        <div class="row g-4">
          <!-- Sidebar -->
          <div class="col-md-3">
            @include('profile.partials.sidebar')
          </div>

          <!-- Konten Pesanan -->
          <div class="col-md-9">
            <div class="card shadow-sm">
              <div class="card-body">
                <h2 class="h5 fw-bold text-dark mb-1">Pesanan Saya</h2>
                <p class="small text-muted mb-0">Kelola Pesanan Anda.</p>

                @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
                @endif

                @forelse($orders as $order)
                  <div class="card mb-4 border">
                    {{-- Header Pesanan --}}
                    <div
                      class="card-header d-flex flex-column flex-md-row justify-content-between 
            align-items-start align-items-md-center bg-light gap-1">

                      <div>
                        <span class="mb-1 d-block">Order #{{ $order->kode_pesanan }}</span>
                        <small class="text-muted">
                          pada tanggal
                          {{ \Carbon\Carbon::parse($order->tanggal_pesanan)->locale('id')->translatedFormat('d F Y') }}
                        </small>
                      </div>

                      {{-- Status --}}
                      <div>
                        @if ($order->status === 'selesai')
                          <span class="badge bg-success">Selesai</span>
                        @elseif($order->status === 'dibayar')
                          <span class="badge bg-primary">Dibayar</span>
                        @elseif($order->status === 'menunggu')
                          <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                        @elseif($order->status === 'diproses')
                          <span class="badge bg-info text-dark">Diproses</span>
                        @elseif($order->status === 'dikirim')
                          <span class="badge bg-info">Dikirim</span>
                        @elseif($order->status === 'dibatalkan')
                          <span class="badge bg-danger">Dibatalkan</span>
                        @else
                          <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                        @endif
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
                          <!-- Metode Pembayaran -->
                          <div class="flex-grow-1">
                            <div class="bg-white p-3 rounded border h-100">
                              <h6 class="fw-semibold mb-2">Metode Pembayaran</h6>

                              @if ($order->metode_pembayaran === 'bank_transfer')
                                <div class="d-flex align-items-start mb-2">
                                  <i class="fa-solid fa-building-columns text-primary fs-6 me-2"></i>
                                  <div>
                                    <div class="fw-semibold small">
                                      Transfer Bank ({{ strtoupper($order->bank) }})
                                    </div>
                                    <small class="text-muted">Metode pembayaran</small>
                                  </div>
                                </div>

                                <div class="d-flex align-items-start">
                                  <i class="fas fa-credit-card text-primary me-2"></i>
                                  <div>
                                    <div class="fw-semibold small">Virtual Account</div>
                                    <small class="text-muted">{{ $order->va_number }}</small>
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

                          <!-- Alamat Pengiriman -->
                          @if ($order->alamat_pengiriman)
                            <div class="flex-grow-1">
                              <div class="bg-white p-3 rounded border h-100">
                                <h6 class="fw-semibold mb-2">Alamat Pengiriman</h6>

                                <div class="d-flex align-items-start">
                                  <i class="fa-solid fa-location-dot text-primary fs-6 me-2"></i>
                                  <div>
                                    <p class="mb-1 small">{{ $order->alamat_pengiriman }}</p>
                                    @if ($order->estimasi_pengiriman)
                                      <small class="text-muted">
                                        <i class="fa-solid fa-clock me-1"></i>
                                        Estimasi tiba:
                                        {{ \Carbon\Carbon::parse($order->estimasi_pengiriman)->locale('id')->translatedFormat('d F Y') }}
                                      </small>
                                    @endif
                                  </div>
                                </div>

                              </div>
                            </div>
                          @endif
                        </div>

                        <!-- Rincian Biaya -->
                        <div>
                          <div class="bg-white p-3 rounded border">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                              <h6 class="fw-semibold mb-0">Rincian Biaya</h6>
                              <span class="fw-bold h5 text-primary mb-0">
                                Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                              </span>
                            </div>

                            <div class="row">
                              <div class="col-md-6 mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                  <span class="text-muted">Subtotal:</span>
                                  <span>Rp{{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                </div>

                                <div class="d-flex justify-content-between small mb-1">
                                  <span class="text-muted">Pajak (11%):</span>
                                  <span>Rp{{ number_format($order->pajak, 0, ',', '.') }}</span>
                                </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                  <span class="text-muted">Biaya Pengiriman:</span>
                                  <span>Rp{{ number_format($order->ongkir, 0, ',', '.') }}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Tombol Aksi -->
                    @if ($order->status === 'dibayar')
                      <div class="card-footer bg-white">
                        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                          <button class="btn btn-primary mb-2 mb-md-0" disabled>
                            <i class="fa-solid fa-circle-check me-2"></i>Pembayaran Berhasil
                          </button>
                          <small class="text-muted ms-md-3">Menunggu diproses oleh penjual</small>
                        </div>
                      </div>
                    @elseif ($order->status === 'menunggu')
                      <div class="card-footer bg-white">
                        <div class="d-flex flex-column flex-md-row gap-2">
                          @if ($order->kode_pesanan)
                            <a href="{{ route('pembayaran.midtrans', ['kode' => $order->kode_pesanan]) }}"
                              class="btn btn-warning d-flex align-items-center">
                              <i class="fa-solid fa-credit-card me-2"></i> Bayar Sekarang
                            </a>

                            <form action="{{ route('pesanan.batalkan', ['kode' => $order->kode_pesanan]) }}"
                              method="POST" class="d-inline">
                              @csrf
                              @method('POST')
                              <button type="submit" class="btn btn-outline-danger d-flex align-items-center"
                                onclick="return confirm('Yakin ingin membatalkan pesanan?')">
                                <i class="fa-solid fa-circle-xmark me-2"></i> Batalkan Pesanan
                              </button>
                            </form>
                          @else
                            <button class="btn btn-danger" disabled>
                              Kode pesanan tidak valid
                            </button>
                          @endif
                        </div>
                      </div>
                    @endif
                  </div>
                @empty
                  <!-- Jika Tidak Ada Pesanan -->
                  <div class="text-center py-5">
                    <div class="mb-4">
                      <div class="display-1 text-muted">
                        <i class="fa-solid fa-bag-shopping"></i>
                      </div>
                    </div>
                    <h3 class="fw-bold mb-3">Belum Ada Pesanan</h3>
                    <p class="text-muted mb-4">Anda belum memiliki pesanan saat ini</p>
                    <a href="{{ route('produk') }}" class="btn btn-primary px-4">
                      <i class="fa-solid fa-cart-shopping me-2"></i> Mulai Belanja
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
