@extends('layouts.app')

@section('title', 'Beri Penilaian Pesanan')

@section('content')
  <div class="py-4 mt-5">
    <div class="container montserrat">
      <div class="row g-4">
        <!-- Sidebar Profile -->
        <div class="col-md-3">
          @include('profile.partials.sidebar')
        </div>

        <!-- Konten Utama -->
        <div class="col-md-9">
          <div class="card shadow-sm">
            <!-- Header -->
            <div class="card-header bg-success text-white">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div class="mb-2 mb-md-0">
                  <h2 class="h5 fw-bold mb-1">
                    <i class="fa-regular fa-star me-2"></i> Beri Penilaian Pesanan
                  </h2>
                  <p class="small mb-0 opacity-75">Bagikan pengalaman Anda tentang produk yang dibeli</p>
                </div>
                <div class="text-md-end">
                  <span class="badge bg-white text-success fs-6">#{{ $order->kode_pesanan }}</span>
                  <div class="text-white-50 small mt-1">
                    {{ $unreviewedProducts->count() }} produk perlu dinilai
                  </div>
                </div>
              </div>
            </div>

            <!-- Body -->
            <div class="card-body">
              <!-- Alert Info -->
              @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="fa-solid fa-circle-exclamation me-2"></i>
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              @endif

              @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <i class="fa-solid fa-circle-check me-2"></i>
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              @endif

              <!-- Progress Bar -->
              @php
                $totalProducts = $order->items->count();
                $reviewedCount = $totalProducts - $unreviewedProducts->count();
                $percentage = $totalProducts > 0 ? ($reviewedCount / $totalProducts) * 100 : 0;
              @endphp

              <div class="alert alert-info">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                  <i class="fa-solid fa-info-circle me-2 mb-2 mb-md-0"></i>
                  <div class="flex-grow-1">
                    <strong class="d-block mb-1">Progress Penilaian</strong>
                    <div class="progress" style="height: 8px;">
                      <div class="progress-bar bg-success d-none d-md-block" style="width: {{ $percentage }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between small mt-2">
                      <span>{{ $reviewedCount }} dari {{ $totalProducts }} produk sudah dinilai</span>
                      <span>{{ number_format($percentage, 0) }}%</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Form Review -->
              <form action="{{ route('reviews.store') }}" method="POST" id="reviewForm">
                @csrf
                <input type="hidden" name="id_pesanan" value="{{ $order->id_pesanan }}">

                <!-- Info Pesanan -->
                <div class="row mb-4">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <div class="card border h-100">
                      <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                          <i class="fa-solid fa-receipt me-2"></i>Info Pesanan
                        </h6>
                        <div class="row">
                          <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                            <small class="text-muted d-block">Kode Pesanan</small>
                            <strong>#{{ $order->kode_pesanan }}</strong>
                          </div>
                          <div class="col-12 col-sm-6">
                            <small class="text-muted d-block">Tanggal</small>
                            <strong>{{ $order->tanggal_pesanan->format('d M Y') }}</strong>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card border h-100">
                      <div class="card-body">
                        <h6 class="fw-semibold mb-3">
                          <i class="fa-solid fa-check-circle me-2"></i>Status
                        </h6>
                        <span class="badge bg-success fs-6 mb-2">
                          <i class="fa-solid fa-check me-1"></i> Selesai
                        </span>
                        <p class="small text-muted mb-0">
                          Pesanan telah selesai dan siap untuk dinilai
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Daftar Produk -->
                <h6 class="fw-semibold mb-4 pb-2 border-bottom">
                  <i class="fa-solid fa-box-open me-2"></i>
                  Produk yang Perlu Dinilai
                  <span class="badge bg-success ms-2">{{ $unreviewedProducts->count() }}</span>
                </h6>

                @foreach ($unreviewedProducts as $index => $data)
                  @php
                    $item = $data['item'];
                    $produk = $data['produk'];
                    $id_produk = $data['produk_id'];
                    $ukuran = $data['ukuran'];
                  @endphp

                  <div class="card border mb-4">
                    <div class="card-body">
                      <div class="row">
                        <!-- Info Produk -->
                        <div class="col-12 col-lg-7 mb-3 mb-lg-0">
                          <div class="d-flex">
                            <div class="position-relative me-3 flex-shrink-0">
                              @if ($produk->foto_utama)
                                <img src="{{ asset($produk->foto_utama) }}" alt="{{ $produk->nama_produk }}"
                                  class="rounded border" style="width: 90px; height: 90px; object-fit: cover;">
                              @else
                                <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                  style="width: 90px; height: 90px;">
                                  <i class="fa-solid fa-image text-muted fa-2x"></i>
                                </div>
                              @endif
                              <span class="badge bg-dark position-absolute top-0 start-100 translate-middle rounded-pill">
                                {{ $item->kuantitas }}x
                              </span>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="fw-bold mb-1">{{ $produk->nama }}</h6>
                              <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                @if ($ukuran)
                                  <span class="badge bg-secondary">
                                    <i class="fa-solid fa-ruler me-1"></i>{{ $ukuran->nama_ukuran }}
                                  </span>
                                @endif
                                <span class="text-muted small">
                                  @ Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </span>
                              </div>
                              <div class="text-success fw-bold">
                                Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Input Review -->
                        <div class="col-12 col-lg-5">
                          <input type="hidden" name="id_produk[]" value="{{ $id_produk }}">

                          <div class="mb-3">
                            <label class="form-label fw-semibold small mb-2">
                              <i class="fa-solid fa-star text-warning me-1"></i>
                              Berikan Rating
                            </label>
                            <input type="hidden" name="rating[{{ $index }}]"
                              id="rating-value-{{ $index }}" value="5">

                            <div class="star-rating-container" data-index="{{ $index }}">
                              <div class="stars d-flex">
                                @for ($i = 1; $i <= 5; $i++)
                                  <i class="fas fa-star star-icon" data-value="{{ $i }}"
                                    data-index="{{ $index }}"
                                    style="font-size: 1.8rem; cursor: pointer; color: #ffc107; margin-right: 5px;"></i>
                                @endfor
                              </div>
                              <div class="rating-text small mt-1">
                                <span class="rating-number text-warning fw-bold">5</span>/5
                              </div>
                            </div>
                          </div>

                          <!-- Komentar -->
                          <div>
                            <label class="form-label fw-semibold small mb-2">
                              <i class="fa-solid fa-comment me-1"></i>
                              Komentar (Opsional)
                            </label>
                            <textarea name="komentar[{{ $index }}]" class="form-control form-control-sm" rows="2"
                              placeholder="Bagaimana pengalaman Anda dengan produk ini?..." maxlength="1000"></textarea>
                            <div class="form-text text-end small">
                              <span class="char-count">0</span>/1000 karakter
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach

                <!-- Tombol Aksi -->
                <div
                  class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4 pt-3 border-top">
                  <a href="{{ route('profile.pesanan') }}"
                    class="btn btn-outline-secondary order-2 order-md-1 w-100 w-md-auto">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Pesanan
                  </a>
                  <button type="submit" class="btn btn-success px-4 order-1 order-md-2 w-100 w-md-auto"
                    id="submitBtn">
                    <i class="fa-solid fa-paper-plane me-2"></i> Kirim Penilaian
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      function initializeStarRating() {
        document.querySelectorAll('.star-rating-container').forEach(container => {
          const index = container.getAttribute('data-index');
          const stars = container.querySelectorAll('.star-icon');
          const hiddenInput = document.getElementById(`rating-value-${index}`);
          const ratingNumber = container.querySelector('.rating-number');

          // Initialize stars
          const initialRating = hiddenInput.value || 5;
          updateStarsDisplay(index, initialRating);

          // Add click event
          stars.forEach(star => {
            star.addEventListener('click', function() {
              const rating = this.getAttribute('data-value');
              hiddenInput.value = rating;
              updateStarsDisplay(index, rating);

              // Add click animation
              this.style.transform = 'scale(1.3)';
              setTimeout(() => {
                this.style.transform = 'scale(1)';
              }, 200);
            });

            // Hover effects
            star.addEventListener('mouseenter', function() {
              const hoverRating = this.getAttribute('data-value');
              previewStars(index, hoverRating);
            });

            star.addEventListener('mouseleave', function() {
              const currentRating = hiddenInput.value;
              updateStarsDisplay(index, currentRating);
            });
          });
        });
      }

      function updateStarsDisplay(index, rating) {
        const container = document.querySelector(`.star-rating-container[data-index="${index}"]`);
        if (!container) return;

        const stars = container.querySelectorAll('.star-icon');
        const ratingNumber = container.querySelector('.rating-number');

        // Update rating number
        if (ratingNumber) {
          ratingNumber.textContent = rating;
        }

        // Update star colors
        stars.forEach(star => {
          const starValue = star.getAttribute('data-value');

          if (starValue <= rating) {
            // Active star
            star.classList.remove('far');
            star.classList.add('fas');
            star.style.color = '#ffc107';
            star.style.textShadow = '0 0 8px rgba(255, 193, 7, 0.5)';
          } else {
            // Inactive star
            star.classList.remove('fas');
            star.classList.add('far');
            star.style.color = '#e4e5e9';
            star.style.textShadow = 'none';
          }
        });
      }

      function previewStars(index, rating) {
        const container = document.querySelector(`.star-rating-container[data-index="${index}"]`);
        if (!container) return;

        const stars = container.querySelectorAll('.star-icon');

        stars.forEach(star => {
          const starValue = star.getAttribute('data-value');

          if (starValue <= rating) {
            // Preview active
            star.classList.remove('far');
            star.classList.add('fas');
            star.style.color = '#ffc107';
            star.style.opacity = '0.9';
          } else {
            // Preview inactive
            star.classList.remove('fas');
            star.classList.add('far');
            star.style.color = '#e4e5e9';
            star.style.opacity = '0.7';
          }
        });
      }

      // Initialize star rating
      initializeStarRating();

      // ==================== CHARACTER COUNTER 
      document.querySelectorAll('textarea').forEach(textarea => {
        const charCount = textarea.parentElement.querySelector('.char-count');

        function updateCharCount() {
          if (charCount) {
            const length = textarea.value.length;
            charCount.textContent = length;

            if (length > 900) {
              charCount.classList.remove('text-warning');
              charCount.classList.add('text-danger', 'fw-bold');
            } else if (length > 700) {
              charCount.classList.remove('text-danger', 'fw-bold');
              charCount.classList.add('text-warning');
            } else {
              charCount.classList.remove('text-danger', 'text-warning', 'fw-bold');
            }
          }
        }

        textarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initialize
      });

      //  FORM SUBMISSION 
      const form = document.getElementById('reviewForm');
      const submitBtn = document.getElementById('submitBtn');

      if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
          e.preventDefault();

          // Validation
          let allRated = true;
          document.querySelectorAll('.star-rating-container').forEach((container, index) => {
            const hiddenInput = document.getElementById(`rating-value-${index}`);
            if (!hiddenInput || !hiddenInput.value) {
              allRated = false;

              // Add visual feedback
              container.classList.add('rating-highlight');
              setTimeout(() => {
                container.classList.remove('rating-highlight');
              }, 2000);
            }
          });

          if (!allRated) {
            showAlert('warning', 'Harap berikan rating untuk semua produk sebelum mengirim.');
            return;
          }

          // Comment length validation
          let invalidComments = [];
          document.querySelectorAll('textarea').forEach((textarea, idx) => {
            if (textarea.value.length > 1000) {
              invalidComments.push(idx + 1);
              textarea.classList.add('is-invalid');
            }
          });

          if (invalidComments.length > 0) {
            showAlert('danger', `Komentar pada produk ${invalidComments.join(', ')} melebihi 1000 karakter.`);
            return;
          }

          // Show loading state
          submitBtn.disabled = true;
          const originalText = submitBtn.innerHTML;
          submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Mengirim...';

          // Submit form
          setTimeout(() => {
            this.submit();
          }, 800);
        });
      }

      function showAlert(type, message) {
        const existingAlerts = document.querySelectorAll('.custom-alert');
        existingAlerts.forEach(alert => alert.remove());

        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} custom-alert alert-dismissible fade show mt-3`;
        alertDiv.innerHTML = `
      <i class="fa-solid ${type === 'warning' ? 'fa-exclamation-triangle' : 'fa-circle-exclamation'} me-2"></i>
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

        // Insert after progress alert
        const progressAlert = document.querySelector('.alert-info');
        if (progressAlert) {
          progressAlert.parentNode.insertBefore(alertDiv, progressAlert.nextSibling);
        } else {
          form.prepend(alertDiv);
        }

        // Scroll to alert
        setTimeout(() => {
          alertDiv.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }, 100);
      }

      //  ADDITIONAL STYLES 
      const style = document.createElement('style');
      style.textContent = `
    .star-icon {
      transition: all 0.2s ease;
    }
    
    .star-icon:hover {
      transform: scale(1.2);
    }
    
    .rating-highlight {
      animation: pulse 1.5s infinite;
      padding: 8px;
      border-radius: 8px;
      background-color: rgba(255, 193, 7, 0.1);
    }
    
    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4); }
      70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
      100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
    }
    
    .card.border {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card.border:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.1) !important;
    }
  `;
      document.head.appendChild(style);
    });
  </script>
@endpush
