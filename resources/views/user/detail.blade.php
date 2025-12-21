@extends('layouts.app')

@section('content')
  <div class="container my-5 mt-5 overflow-hidden" id="product-detail-page">
    {{-- Tombol kembali --}}
    <a href="{{ url('/produk') }}" class="btn btn-outline-success mb-4 mt-5 montserrat" id="back-button">
      <i class="fa-solid fa-arrow-left mx-1"></i> Kembali ke Produk
    </a>

    {{-- Bagian detail produk --}}
    <div class="row g-5" id="product-main-section">
      {{-- Gallery Foto Produk --}}
      <div class="col-md-5" id="product-gallery">
        {{-- Foto Utama --}}
        <div class="text-center mb-3" id="main-image-container">
          <img id="main-image" src="{{ asset($produk->foto_utama) }}" alt="{{ $produk->nama }}"
            class="img-fluid rounded shadow-sm product-main-image cursor-pointer" data-bs-toggle="modal"
            data-bs-target="#imageModal">
        </div>

        {{-- Thumbnail Gallery --}}
        @if ($produk->fotoProduk && $produk->fotoProduk->count() > 0)
          <div class="row g-2" id="thumbnail-gallery">
            {{-- Thumbnail foto utama --}}
            <div class="col-3">
              <img src="{{ asset($produk->foto_utama) }}" alt="{{ $produk->nama }}"
                class="img-thumbnail gallery-thumb active"
                onclick="changeMainImage('{{ asset($produk->foto_utama) }}', this)">
            </div>

            {{-- Thumbnail foto tambahan --}}
            @foreach ($produk->fotoProduk as $foto)
              <div class="col-3">
                <img src="{{ asset($foto->foto) }}" alt="{{ $produk->nama }}" class="img-thumbnail gallery-thumb"
                  onclick="changeMainImage('{{ asset($foto->foto) }}', this)">
              </div>
            @endforeach
          </div>
        @else
          {{-- Jika tidak ada foto tambahan, tetap tampilkan thumbnail foto utama --}}
          <div class="row g-2" id="single-thumbnail">
            <div class="col-3">
              <img src="{{ asset($produk->foto_utama) }}" alt="{{ $produk->nama }}"
                class="img-thumbnail gallery-thumb active"
                onclick="changeMainImage('{{ asset($produk->foto_utama) }}', this)">
            </div>
          </div>
        @endif
      </div>

      {{-- Info produk --}}
      <div class="col-md-7" id="product-info">
        <h1 class="fw-bold mb-1 fraunces" id="product-title">{{ $produk->nama }}</h1>
        <p class="mb-3 montserrat small fst-italic" id="product-scientific-name">
          {{ $produk->detailTanaman->nama_ilmiah ?? 'Tanaman hias yang cantik dan mudah perawatan' }}</p>

        {{-- Rating dan Terjual --}}
        <div class="d-flex align-items-center gap-1 mb-2 montserrat" id="product-stats">
          <span class="badge bg-success" id="sold-badge">
            <i class="fas fa-fire me-1"></i> Terjual {{ $produk->terjual_formatted }}
          </span>
          <span class="badge bg-warning text-dark" id="rating-badge">
            <i class="fas fa-star me-1"></i> {{ number_format($produk->rating, 1) }}
            ({{ $produk->jumlah_rating }} rating)
          </span>
        </div>

        {{-- BAGIAN REALTIME DENGAN LIVEWIRE --}}
        @livewire('ProductDetail', ['produk' => $produk])
      </div>
    </div>

    {{-- Modal untuk Zoom Image --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img id="modal-image" src="" alt="{{ $produk->nama }}" class="img-fluid modal-image-content">
          </div>
        </div>
      </div>
    </div>

    {{-- Detail Informasi Produk --}}
    <div class="row mt-4" id="product-details-section">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            {{-- Tabs Deskripsi --}}
            <ul class="nav nav-tabs" id="productTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active fraunces" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                  type="button">
                  Deskripsi Produk
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link fraunces" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail"
                  type="button">
                  Detail Tanaman
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link fraunces" id="care-tab" data-bs-toggle="tab" data-bs-target="#care"
                  type="button">
                  Petunjuk Perawatan
                </button>
              </li>
              @if ($produk->fotoProduk && $produk->fotoProduk->count() > 0)
                <li class="nav-item" role="presentation">
                  <button class="nav-link fraunces" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                    type="button">
                    Gallery Foto
                  </button>
                </li>
              @endif
            </ul>

            <div class="tab-content border border-top-0 p-4 rounded-bottom" id="productTabContent"
              style="max-height: 500px; overflow-y: auto;">
              {{-- Tab Deskripsi --}}
              <div class="tab-pane fade show active" id="desc" role="tabpanel">
                <div class="small mb-0 montserrat">
                  {!! nl2br(e($produk->deskripsi ?? 'Tidak ada deskripsi.')) !!}
                </div>
              </div>

              {{-- Tab Detail Tanaman --}}
              <div class="tab-pane fade" id="detail" role="tabpanel">
                @if ($produk->detailTanaman)
                  <div class="row">
                    <div class="col-md-8">
                      <div class="mb-3">
                        <p class="montserrat mb-1 detail-text">
                          <strong class="fraunces">Nama Tanaman</strong><br>
                          {{ $produk->nama ?? '-' }}
                        </p>
                      </div>
                      <div class="mb-3">
                        <p class="montserrat mb-1 detail-text">
                          <strong class="fraunces">Nama Ilmiah</strong><br>
                          {{ $produk->detailTanaman->nama_ilmiah ?? '-' }}
                        </p>
                      </div>
                      <div class="mb-3">
                        <p class="montserrat mb-1 detail-text">
                          <strong class="fraunces">Asal</strong><br>
                          {{ $produk->detailTanaman->asal_tanaman ?? '-' }}
                        </p>
                      </div>
                      <div class="mb-3">
                        <p class="montserrat mb-1 detail-text">
                          <strong class="fraunces">Jenis Tanaman</strong><br>
                          {{ $produk->kategori?->nama_kategori ?? '-' }}
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <p class="montserrat mb-1 detail-text">
                          <strong class="fraunces">Ukuran</strong><br>
                          {{ $produk->detailTanaman->ukuran_detail ?? '-' }}
                        </p>
                      </div>
                    </div>
                  </div>
                @else
                  <p class="text-muted detail-text">Detail tanaman belum tersedia.</p>
                @endif
              </div>

              {{-- Tab Perawatan --}}
              <div class="tab-pane fade" id="care" role="tabpanel">
                @if ($produk->petunjukPerawatan)
                  <div class="row" id="care-cards-container">
                    <div class="col-md-4 mb-3">
                      <div class="card h-100 border-0 bg-light care-card">
                        <div class="card-body text-center">
                          <i class="fas fa-tint text-primary fa-2x mb-3"></i>
                          <h6 class="fw-bold fraunces">Penyiraman</h6>
                          <p class="small mb-0 montserrat">
                            {{ $produk->petunjukPerawatan->penyiraman ?? '-' }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <div class="card h-100 border-0 bg-light care-card">
                        <div class="card-body text-center">
                          <i class="fas fa-sun text-warning fa-2x mb-3"></i>
                          <h6 class="fw-bold fraunces">Cahaya</h6>
                          <p class="small mb-0 montserrat">
                            {{ $produk->petunjukPerawatan->cahaya ?? '-' }}
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <div class="card h-100 border-0 bg-light care-card">
                        <div class="card-body text-center">
                          <i class="fas fa-thermometer-half text-info fa-2x mb-3"></i>
                          <h6 class="fw-bold fraunces">Suhu & Kelembapan</h6>
                          <p class="small mb-0 montserrat">
                            {{ $produk->petunjukPerawatan->suhu_dan_kelembapan ?? '-' }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <p class="text-muted">Belum ada petunjuk perawatan untuk produk ini.</p>
                @endif
              </div>

              {{-- Tab Gallery Foto --}}
              @if ($produk->fotoProduk && $produk->fotoProduk->count() > 0)
                <div class="tab-pane fade" id="gallery" role="tabpanel">
                  <div class="row g-3" id="gallery-grid">
                    <div class="col-md-6 col-lg-4">
                      <div class="card border-0 gallery-card">
                        <img src="{{ asset($produk->foto_utama) }}" alt="{{ $produk->nama }}"
                          class="card-img-top rounded gallery-image" data-bs-toggle="modal"
                          data-bs-target="#imageModal" onclick="setModalImage('{{ asset($produk->foto_utama) }}')">
                        <div class="card-body text-center">
                          <small class="text-muted montserrat">Foto Utama</small>
                        </div>
                      </div>
                    </div>
                    @foreach ($produk->fotoProduk as $index => $foto)
                      <div class="col-md-6 col-lg-4">
                        <div class="card border-0 gallery-card">
                          <img src="{{ asset($foto->foto) }}" alt="{{ $produk->nama }}"
                            class="card-img-top rounded gallery-image" data-bs-toggle="modal"
                            data-bs-target="#imageModal" onclick="setModalImage('{{ asset($foto->foto) }}')">
                          <div class="card-body text-center">
                            <small class="text-muted montserrat">Foto
                              {{ $index + 1 }}</small>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Penilaian Produk --}}
    <div class="row mt-4" id="rating-section">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <strong class="fw-bold mb-4 fraunces h5 m-3">Penilaian Produk</strong>
            <div class="row mb-4" id="rating-summary">
              <div class="col-md-4 text-center">
                <div class="border-end pe-4" id="rating-overview">
                  <h1 class="text-success fw-bold display-4 mt-2">
                    {{ number_format($produk->rating, 1) }}
                  </h1>
                  <div class="mb-2" id="rating-stars">
                    @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= floor($produk->rating))
                        <i class="fas fa-star text-success"></i>
                      @elseif($i - 0.5 <= $produk->rating)
                        <i class="fas fa-star-half-alt text-success"></i>
                      @else
                        <i class="far fa-star text-success"></i>
                      @endif
                    @endfor
                  </div>
                  <p class="text-muted montserrat">berdasarkan {{ $produk->jumlah_rating }} ulasan</p>
                </div>
              </div>
              <div class="col-md-8">
                <p class="fw-bold mb-3 h6 d-block fraunces">Detail Rating</p>
                @php
                  $ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                  $totalReviews = 0;
                  if ($produk->reviews && $produk->reviews->count() > 0) {
                      foreach ($produk->reviews as $review) {
                          if (isset($ratingCounts[$review->rating])) {
                              $ratingCounts[$review->rating]++;
                              $totalReviews++;
                          }
                      }
                  }
                @endphp
                @for ($i = 5; $i >= 1; $i--)
                  <div class="d-flex align-items-center mb-2 rating-bar">
                    <small class="text-muted me-2">{{ $i }}</small>
                    <i class="fas fa-star text-success me-1"></i>
                    <div class="progress flex-grow-1 me-3 rounded-md">
                      <div class="progress-bar bg-success"
                        style="width: {{ $totalReviews > 0 ? ($ratingCounts[$i] / $totalReviews) * 100 : 0 }}%">
                      </div>
                    </div>
                    <small class="text-muted">{{ $ratingCounts[$i] }}</small>
                  </div>
                @endfor
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Ulasan Pengguna --}}
    <div class="row mt-4" id="reviews-section">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            @livewire('product-reviews', ['produkId' => $produk->id_produk])
          </div>
        </div>
      </div>
    </div>

    {{-- Produk Terkait --}}
    @if ($relatedProducts && $relatedProducts->count() > 0)
      <div class="mt-5" id="related-products-section">
        <strong class="fw-bold mb-5 fraunces h5">Kamu Mungkin Juga Suka</strong>
        <div class="row g-4 mt-1" id="related-products-grid">
          @foreach ($relatedProducts as $item)
            @php
              $totalStok = $item->produkUkuran ? $item->produkUkuran->sum('stok') : 0;
            @endphp
            <div class="col-6 col-md-4 col-lg-3 product-card">
              <div class="card h-100 border-0 shadow-sm product-item">
                <div class="position-relative">
                  <img src="{{ asset($item->foto_utama) }}" alt="{{ $item->nama }}"
                    class="card-img-top rounded-top-3 related-product-image">
                  @if ($totalStok <= 0)
                    <div
                      class="position-absolute top-0 start-0 w-100 h-100 bg-light bg-opacity-75 d-flex align-items-center justify-content-center rounded-top-3">
                      <span class="badge bg-danger montserrat fs-6 p-2">Stok Habis</span>
                    </div>
                  @elseif($totalStok < 10)
                    <div class="position-absolute top-0 end-0 m-2">
                      <span class="badge bg-warning text-dark montserrat">Stok Menipis:
                        {{ $totalStok }}</span>
                    </div>
                  @endif
                </div>
                <div class="card-body d-flex flex-column">
                  <h6 class="card-title fraunces mb-1 related-product-title">
                    {{ \Illuminate\Support\Str::limit($item->nama, 40) }}
                  </h6>
                  <p class="card-text montserrat mb-0 text-success fw-semibold related-product-price">
                    RP{{ number_format($item->harga_terendah, 0, ',', '.') }}
                  </p>
                  <div class="d-flex align-items-center justify-content-between mb-3 montserrat related-product-stats">
                    <div class="d-flex align-items-center">
                      <span class="text-warning me-1">
                        <i class="fas fa-star"></i>
                      </span>
                      <small class="text-muted">{{ number_format($item->rating ?? 0, 1) }}</small>
                    </div>
                    <small class="text-muted">{{ $item->terjual_formatted ?? ($item->terjual ?? 0) }}
                      terjual</small>
                  </div>
                  @if ($totalStok <= 0)
                    <button class="btn btn-outline-secondary btn-sm mt-auto montserrat" disabled>
                      Stok Habis
                    </button>
                  @else
                    <a href="{{ route('produk.detail', $item->id_produk) }}"
                      class="btn-collision mt-auto d-flex justify-content-center align-items-center montserrat">
                      <span>Lihat Detail</span> <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                  @endif
                  @if ($totalStok > 0)
                    <small class="text-muted montserrat mt-2 text-center related-product-stock">
                      Stok Tersedia: {{ $totalStok }}
                    </small>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>

  {{-- Script untuk interaksi --}}
  <script>
    // Fungsi untuk mengganti gambar utama
    function changeMainImage(imageSrc, element) {
      document.getElementById('main-image').src = imageSrc;
      document.getElementById('modal-image').src = imageSrc;
      document.querySelectorAll('.gallery-thumb').forEach(thumb => {
        thumb.classList.remove('active');
        thumb.style.borderColor = '#dee2e6';
      });
      element.classList.add('active');
      element.style.borderColor = '#1d3a1a';
    }

    // Fungsi untuk set image modal
    function setModalImage(imageSrc) {
      document.getElementById('modal-image').src = imageSrc;
    }

    // Event listener untuk main image click (buka modal)
    function initializeImageModal() {
      const mainImage = document.getElementById('main-image');
      if (mainImage) {
        mainImage.addEventListener('click', function() {
          setModalImage(this.src);
        });
      }

      document.querySelectorAll('.gallery-image').forEach(img => {
        img.addEventListener('click', function() {
          setModalImage(this.src);
        });
      });
    }

    // Inisialisasi ketika DOM siap
    document.addEventListener('DOMContentLoaded', function() {
      initializeImageModal();

      document.querySelectorAll('.gallery-thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
          const imageSrc = this.src;
          setModalImage(imageSrc);
        });
      });
    });

    // Livewire event listeners - MENGGUNAKAN TOAST SYSTEM ANDA
    document.addEventListener('livewire:init', function() {

      Livewire.on('cart-updated', function() {
        updateCartCounter();
        showSuccessAnimation();
      });

      Livewire.on('show-alert', function(data) {

        // Handle data dari Livewire dan trigger toast system Anda
        handleLivewireAlert(data);
      });

      Livewire.on('show-login-modal', function() {
        const loginModalElement = document.getElementById('loginModal');
        if (loginModalElement) {
          const loginModal = new bootstrap.Modal(loginModalElement);
          loginModal.show();
        } else {
          console.error('Login modal element not found');
        }
      });
    });

    // Function untuk handle alert dari Livewire
    function handleLivewireAlert(data) {
      let type, message;

      if (Array.isArray(data) && data.length > 0) {
        // Data datang sebagai array (Livewire v3)
        type = data[0]?.type;
        message = data[0]?.message;
      } else if (data && typeof data === 'object') {
        // Data datang sebagai object
        type = data.type;
        message = data.message;
      }

      if (type && message) {
        // Trigger toast system yang sudah ada
        const toastEvent = new CustomEvent('show-toast', {
          detail: {
            type,
            message
          }
        });
        window.dispatchEvent(toastEvent);
      } else {
        // Fallback error toast
        const toastEvent = new CustomEvent('show-toast', {
          detail: {
            type: 'error',
            message: 'Terjadi kesalahan sistem'
          }
        });
        window.dispatchEvent(toastEvent);
      }
    }

    function updateCartCounter() {
      const counter = document.getElementById('cart-count');
      if (counter) {
        let currentCount = parseInt(counter.textContent) || 0;
        counter.textContent = currentCount + 1;

        // Animasi
        counter.classList.add('pulse');
        setTimeout(() => counter.classList.remove('pulse'), 500);
      } else {
        console.warn('Cart counter element not found');
      }
    }

    function showSuccessAnimation() {
      const btn = document.getElementById('add-to-cart-btn');
      if (btn) {
        // Store original state
        const originalHTML = btn.innerHTML;
        const originalClass = btn.className;

        // Change to success state
        btn.innerHTML = '<i class="fas fa-check me-2"></i>Berhasil Ditambahkan!';
        btn.className = 'btn btn-success flex-fill py-3';
        btn.disabled = true;

        // Revert after 2 seconds
        setTimeout(() => {
          btn.innerHTML = originalHTML;
          btn.className = originalClass;
          btn.disabled = false;
        }, 2000);
      } else {
        console.warn('⚠️ Add to cart button not found for animation');
      }
    }

    // CSS untuk pulse animation
    if (!document.querySelector('#product-detail-animations')) {
      const style = document.createElement('style');
      style.id = 'product-detail-animations';
      style.textContent = `
            .pulse {
                animation: pulse 0.5s ease-in-out;
            }
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }
        `;
      document.head.appendChild(style);
    }

    // Test function untuk manual testing
    window.testToast = function() {
      const toastEvent = new CustomEvent('show-toast', {
        detail: {
          type: 'success',
          message: 'Test toast berhasil!'
        }
      });
      window.dispatchEvent(toastEvent);
    };
  </script>
@endsection
