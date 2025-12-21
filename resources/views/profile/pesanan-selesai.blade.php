@extends('layouts.app')

@section('title', 'Pesanan Selesai')

@section('content')
  <section>
    <div class="py-4 mt-5">
      <div class="container montserrat">
        <div class="row g-4">
          <!-- Sidebar -->
          <div class="col-md-3">
            @include('profile.partials.sidebar')
          </div>

          <!-- Konten Pesanan Selesai -->
          <div class="col-md-9">
            <div class="card shadow-sm">
              <div class="card-body">
                <h2 class="h5 fw-bold text-dark mb-1">Pesanan Selesai</h2>
                <p class="small text-muted mb-0">Pesanan yang telah selesai dan diterima.</p>

                @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
                @endif

                @forelse($orders as $order)
                  <div class="card mb-4 border">
                    {{-- Header Pesanan Selesai --}}
                    <div
                      class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center bg-light gap-1">
                      <div>
                        <span class="mb-1 d-block">Order #{{ $order->kode_pesanan }}</span>
                        <small class="text-muted">
                          Selesai pada tanggal
                          {{ \Carbon\Carbon::parse($order->updated_at)->locale('id')->translatedFormat('d F Y') }}
                        </small>
                      </div>

                      {{-- Status Selesai --}}
                      <div>
                        <span class="badge bg-success">Selesai</span>
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

                          <!-- Total Harga -->
                          <div class="flex-grow-1">
                            <div class="bg-white p-3 rounded border h-100">
                              <h6 class="fw-semibold mb-2">Total Pembayaran</h6>
                              <div class="d-flex align-items-center">
                                <i class="fa-solid fa-receipt text-primary fs-6 me-2"></i>
                                <div>
                                  <div class="fw-bold h5 m-0 text-primary">
                                    Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                                  </div>
                                  <small class="text-muted">Sudah termasuk pajak dan ongkir</small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Tombol Aksi untuk Pesanan Selesai -->
                    <div class="bg-white">
                      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 mt-2 pt-2">
                        @php
                          $unreviewedCount = $order->produkBelumDireview()->count();
                        @endphp

                        @if ($unreviewedCount > 0)
                          <a href="{{ route('reviews.create', ['order_id' => $order->id_pesanan]) }}"
                            class="btn btn-outline-success order-2 order-md-1 w-100 w-md-auto">
                            <i class="fa-regular fa-star me-2"></i> Berikan Penilaian
                            @if ($unreviewedCount > 1)
                              <span class="badge btn-green ms-1">{{ $unreviewedCount }}</span>
                            @endif
                          </a>
                        @else
                          <button class="btn btn-outline-secondary order-2 order-md-1 w-100 w-md-auto " disabled>
                            <i class="fa-solid fa-star me-2"></i> Semua Sudah Dinilai
                          </button>
                        @endif
                        <!-- Tampilkan link ke review jika sudah ada -->
                        @if ($order->reviews->count() > 0)
                          @php
                            $firstReview = $order->reviews->first();
                            $produkId = $firstReview->produk->id_produk ?? null;
                          @endphp
                          @if ($produkId)
                            <a href="{{ route('profile.ulasan') }}"
                              class="btn btn-green text-light px-4 order-1 order-md-2 w-100 w-md-auto">
                              <i class="fa-solid fa-eye me-2"></i> Lihat Penilaian
                            </a>
                          @endif
                        @endif
                      </div>
                    </div>
                  </div>
                @empty
                  <!-- Jika Tidak Ada Pesanan Selesai -->
                  <div class="text-center py-5">
                    <div class="mb-4">
                      <div class="display-1 text-muted">
                        <i class="fa-solid fa-check-circle"></i>
                      </div>
                    </div>
                    <h3 class="fw-bold mb-3">Belum Ada Pesanan Selesai</h3>
                    <p class="text-muted mb-4">Anda belum memiliki pesanan yang telah selesai</p>
                    <a href="{{ route('profile.pesanan') }}" class="btn btn-outline-primary px-4">
                      <i class="fa-solid fa-list me-2"></i> Lihat Pesanan Aktif
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
