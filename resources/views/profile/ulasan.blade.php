@extends('layouts.app')

@section('title', 'Ulasan Saya')

@section('content')
  <section>
    <div class="py-4 mt-5">
      <div class="container montserrat">
        <div class="row g-4">
          <!-- Sidebar -->
          <div class="col-md-3">
            @include('profile.partials.sidebar')
          </div>

          <!-- Konten Ulasan -->
          <div class="col-md-9">
            <div class="card shadow-sm">
              <div class="card-body">
                <h2 class="h5 fw-bold text-dark mb-1">Ulasan Saya</h2>
                <p class="small text-muted mb-0">Kelola penilaian Anda untuk produk yang dibeli.</p>

                @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
                @endif

                <!-- Statistik Ulasan -->
                <div class="row g-3 mt-4 mb-4">
                  <div class="col-md-4">
                    <div class="card border-0 bg-light">
                      <div class="card-body text-center">
                        <h3 class="fw-bold text-primary mb-0">{{ $totalReviews }}</h3>
                        <p class="text-muted mb-0 small">Total Ulasan</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card border-0 bg-light">
                      <div class="card-body text-center">
                        <h3 class="fw-bold text-warning mb-0">{{ number_format($averageRating, 1) }}/5</h3>
                        <p class="text-muted mb-0 small">Rating Rata-rata</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card border-0 bg-light">
                      <div class="card-body text-center">
                        <h3 class="fw-bold text-success mb-0">{{ $fiveStarCount }}</h3>
                        <p class="text-muted mb-0 small">Ulasan 5 Bintang</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Daftar Ulasan -->
                @if ($reviews->isEmpty())
                  <!-- Jika Tidak Ada Ulasan -->
                  <div class="text-center py-5">
                    <div class="mb-4">
                      <div class="fs-1 text-muted">
                        <i class="fa-solid fa-star"></i>
                      </div>
                    </div>
                    <h3 class="fw-bold mb-3">Belum Ada Ulasan</h3>
                    <p class="text-muted mb-4">Anda belum memberikan penilaian untuk produk yang dibeli</p>
                    <a href="{{ route('profile.pesanan') }}" class="btn btn-primary px-4">
                      <i class="fa-solid fa-boxes-packing me-2"></i> Lihat Pesanan Saya
                    </a>
                  </div>
                @else
                  @foreach ($reviews as $review)
                    <div class="card mb-4 border">
                      <!-- Header Ulasan -->
                      <div
                        class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center bg-light">
                        <div>
                          <span class="mb-1 d-block">Review #{{ $review->id_review }}</span>
                          <small class="text-muted">
                            pada tanggal
                            {{ \Carbon\Carbon::parse($review->tanggal_review)->locale('id')->translatedFormat('d F Y') }}
                          </small>
                        </div>
                        <div>
                          <small class="text-muted">
                            Pesanan #{{ $review->pesanan->kode_pesanan ?? $review->id_pesanan }}
                          </small>
                        </div>
                      </div>

                      <!-- Detail Ulasan -->
                      <div class="card-body">
                        <div class="row">
                          <!-- Info Produk -->
                          <div class="col-md-8">
                            <div class="d-flex align-items-start">
                              @if ($review->produk->foto_utama)
                                <img src="{{ asset($review->produk->foto_utama) }}"
                                  alt="{{ $review->produk->nama_produk }}" class="rounded border me-3"
                                  style="width: 80px; height: 80px; object-fit: cover;">
                              @else
                                <div class="bg-light rounded border d-flex align-items-center justify-content-center me-3"
                                  style="width: 80px; height: 80px;">
                                  <i class="fa-solid fa-image text-muted fa-2x"></i>
                                </div>
                              @endif
                              <div>
                                <h6 class="fw-semibold mb-1">{{ $review->produk->nama }}</h6>
                                <div class="text-muted small mb-2">
                                  <i class="fa-solid fa-box-open me-1"></i> Produk
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Rating -->
                          <div class="col-md-4 mt-3 mt-md-0">
                            <div class="d-flex align-items-center justify-content-md-end justify-content-center">
                              <div class="text-center">
                                <div class="mb-2">
                                  @for ($i = 1; $i <= 5; $i++)
                                    <i
                                      class="fa-solid fa-star fs-5 {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                  @endfor
                                </div>
                                <div class="fw-bold h5 text-warning mb-0">
                                  {{ $review->rating }}/5
                                </div>
                                <small class="text-muted">Rating</small>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Komentar -->
                        @if ($review->komentar)
                          <div class="mt-4">
                            <h6 class="fw-semibold mb-2">
                              <i class="fa-solid fa-comment me-2"></i>Komentar Anda
                            </h6>
                            <div class="bg-light p-3 rounded">
                              <p class="mb-0">{{ $review->komentar }}</p>
                            </div>
                          </div>
                        @endif
                      </div>

                      <!-- Footer Ulasan - Tombol Aksi -->
                      <div class="card-footer bg-white">
                        <div class="d-flex flex-column flex-md-row gap-2">
                          <!-- Tombol Lihat Produk -->
                          <a href="{{ route('produk.detail', $review->produk->id_produk) }}#rating-section"
                            class="btn btn-outline-success btn-sm text-center">
                            <i class="fa-solid fa-eye me-1"></i>
                            <span class="d-none d-md-inline">Lihat di Produk</span>
                            <span class="d-md-none">Lihat</span>
                          </a>

                          <!-- Tombol Edit Review -->
                          <a href="{{ route('reviews.edit', $review->id_review) }}"
                            class="btn btn-outline-warning btn-sm text-center">
                            <i class="fa-solid fa-pen me-1"></i>
                            <span class="d-none d-md-inline">Edit Ulasan</span>
                            <span class="d-md-none">Edit</span>
                          </a>

                          <!-- Tombol Delete -->
                          <form action="{{ route('reviews.destroy', $review->id_review) }}" method="POST"
                            class="d-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                              onclick="return confirm('Apakah Anda yakin ingin menghapus review ini?')">
                              <i class="fa-solid fa-trash me-1"></i>
                              <span class="d-none d-md-inline">Hapus</span>
                              <span class="d-md-none">Hapus Ulasan</span>
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach

                  <!-- Pagination -->
                  @if ($reviews->hasPages())
                    <div class="mt-4">
                      <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                          {{ $reviews->links('pagination::bootstrap-5') }}
                        </ul>
                      </nav>
                    </div>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Alert auto dismiss
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        setTimeout(() => {
          const bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        }, 5000);
      });
    });
  </script>
@endpush
