@extends('layouts.app')

@section('title', 'Edit Review')

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
            <div class="card-header bg-primary text-white">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div class="mb-2 mb-md-0">
                  <h2 class="h5 fw-bold mb-1">
                    <i class="fa-solid fa-edit me-2"></i> Edit Review
                  </h2>
                  <p class="small mb-0 opacity-75">Perbarui penilaian Anda untuk produk ini</p>
                </div>
                <div class="text-md-end">
                  <span class="badge bg-white text-primary fs-6">#{{ $review->pesanan->kode_pesanan ?? '' }}</span>
                  <div class="text-white-50 small mt-1">
                    {{ $review->tanggal_review->format('d M Y') }}
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

              <!-- Info Produk -->
              <div class="row mb-4">
                <div class="col-md-8 mb-3 mb-md-0">
                  <div class="card border h-100">
                    <div class="card-body">
                      <h6 class="fw-semibold mb-3">
                        <i class="fa-solid fa-box-open me-2"></i>Produk yang Dinilai
                      </h6>

                      {{-- Tampilkan jika ada produk --}}
                      @if (isset($review->produk))
                        <div class="d-flex">
                          {{-- Foto Produk --}}
                          @if (!empty($review->produk->foto_utama))
                            <div class="position-relative me-3 flex-shrink-0">
                              <img src="{{ asset($review->produk->foto_utama) }}" alt="{{ $review->produk->nama }}"
                                class="rounded border" style="width: 90px; height: 90px; object-fit: cover;">
                            </div>
                          @else
                            <div class="position-relative me-3 flex-shrink-0">
                              <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                style="width: 90px; height: 90px;">
                                <i class="fa-solid fa-image text-muted fa-2x"></i>
                              </div>

                              @if (isset($item) && !empty($item->kuantitas))
                                <span
                                  class="badge bg-dark position-absolute top-0 start-100 translate-middle rounded-pill">
                                  {{ $item->kuantitas }}x
                                </span>
                              @endif
                            </div>
                          @endif

                          {{-- Info Produk --}}
                          <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">{{ $review->produk->nama }}</h6>

                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                              {{-- Ukuran --}}
                              @if (isset($ukuran) && !empty($ukuran->nama_ukuran))
                                <span class="badge bg-secondary">
                                  <i class="fa-solid fa-ruler me-1"></i>{{ $ukuran->nama_ukuran }}
                                </span>
                              @endif

                              {{-- Harga --}}
                              @if (isset($item) && !empty($item->harga_satuan))
                                <span class="text-muted small">
                                  @ Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </span>
                              @elseif (isset($review->produk->harga) && !empty($review->produk->harga))
                                <span class="text-muted small">
                                  @ Rp {{ number_format($review->produk->harga, 0, ',', '.') }}
                                </span>
                              @endif
                            </div>

                            {{-- Total Harga --}}
                            <div class="text-success fw-bold">
                              @if (isset($item) && !empty($item->harga_satuan) && !empty($item->kuantitas))
                                Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}
                              @elseif (isset($review->produk->harga) && !empty($review->produk->harga))
                                Rp {{ number_format($review->produk->harga, 0, ',', '.') }}
                              @else
                                <span class="text-muted">Harga tidak tersedia</span>
                              @endif
                            </div>
                          </div>
                        </div>
                      @else
                        <div class="alert alert-warning">
                          <i class="fa-solid fa-triangle-exclamation me-2"></i>
                          Data produk tidak ditemukan. Review ID: {{ $review->id_review }}
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card border h-100">
                    <div class="card-body">
                      <h6 class="fw-semibold mb-3">
                        <i class="fa-solid fa-star me-2"></i>Rating Saat Ini
                      </h6>
                      <div class="d-flex align-items-center mb-2">
                        <div class="current-rating-stars">
                          @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-star {{ $i <= $review->rating ? 'fas text-warning' : 'far text-muted' }}"
                              style="font-size: 1.5rem;"></i>
                          @endfor
                        </div>
                        <span class="badge bg-warning text-dark ms-2 fs-6">
                          {{ $review->rating }}/5
                        </span>
                      </div>
                      <p class="small text-muted mb-0">
                        Terakhir diperbarui: {{ $review->updated_at->format('d M Y') }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Form Edit -->
              <form action="{{ route('reviews.update', $review->id_review) }}" method="POST" id="editReviewForm">
                @csrf
                @method('PUT')

                <!-- Rating -->
                <div class="mb-4">
                  <label class="form-label fw-semibold small mb-2">
                    <i class="fa-solid fa-star text-warning me-1"></i>
                    Perbarui Rating
                  </label>
                  <input type="hidden" name="rating" id="rating-value" value="{{ $review->rating }}">

                  <div class="star-rating-container" data-index="edit">
                    <div class="stars d-flex">
                      @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star star-icon" data-value="{{ $i }}" data-index="edit"
                          style="font-size: 1.8rem; cursor: pointer; 
                                 color: {{ $i <= $review->rating ? '#ffc107' : '#ffc107' }};
                                 margin-right: 5px;"></i>
                      @endfor
                    </div>
                    <div class="rating-text small mt-1">
                      <span class="rating-number text-warning fw-bold">{{ $review->rating }}</span>/5
                    </div>
                  </div>
                </div>

                <!-- Komentar -->
                <div class="mb-4">
                  <label class="form-label fw-semibold small mb-2">
                    <i class="fa-solid fa-comment me-1"></i>
                    Perbarui Komentar
                  </label>
                  <textarea name="komentar" class="form-control form-control-sm" rows="4"
                    placeholder="Bagaimana pengalaman Anda dengan produk ini?..." maxlength="1000">{{ old('komentar', $review->komentar) }}</textarea>
                  <div class="form-text text-end small">
                    <span class="char-count">{{ strlen($review->komentar ?? '') }}</span>/1000 karakter
                  </div>
                </div>

                <!-- Tombol Aksi -->
                <div
                  class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4 pt-3 border-top">
                  <a href="{{ route('profile.ulasan') }}"
                    class="btn btn-outline-secondary order-2 order-md-1 w-100 w-md-auto">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Ulasan
                  </a>
                  <button type="submit" class="btn btn-primary px-4 order-1 order-md-2 w-100 w-md-auto"
                    id="submitBtn">
                    <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
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
      //  STAR RATING SYSTEM
      function initializeStarRating() {
        const container = document.querySelector('.star-rating-container[data-index="edit"]');
        const stars = container.querySelectorAll('.star-icon');
        const hiddenInput = document.getElementById('rating-value');
        const ratingNumber = container.querySelector('.rating-number');

        // Initialize stars
        const initialRating = hiddenInput.value || {{ $review->rating }};
        updateStarsDisplay('edit', initialRating);

        // Add click event to stars
        stars.forEach(star => {
          star.addEventListener('click', function() {
            const rating = this.getAttribute('data-value');
            hiddenInput.value = rating;
            updateStarsDisplay('edit', rating);

            // Add click animation
            this.style.transform = 'scale(1.3)';
            setTimeout(() => {
              this.style.transform = 'scale(1)';
            }, 200);
          });

          // Hover effects
          star.addEventListener('mouseenter', function() {
            const hoverRating = this.getAttribute('data-value');
            previewStars('edit', hoverRating);
          });

          star.addEventListener('mouseleave', function() {
            const currentRating = hiddenInput.value;
            updateStarsDisplay('edit', currentRating);
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

      //  CHARACTER COUNTER
      const textarea = document.querySelector('textarea[name="komentar"]');
      const charCount = document.querySelector('.char-count');

      function updateCharCount() {
        if (textarea && charCount) {
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

      if (textarea) {
        textarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initialize
      }

      //  FORM SUBMISSION
      const form = document.getElementById('editReviewForm');
      const submitBtn = document.getElementById('submitBtn');

      if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
          e.preventDefault();

          // Comment length validation
          if (textarea.value.length > 1000) {
            showAlert('danger', 'Komentar melebihi 1000 karakter. Harap perpendek komentar Anda.');
            textarea.classList.add('is-invalid');
            return;
          }

          // Show loading state
          submitBtn.disabled = true;
          const originalText = submitBtn.innerHTML;
          submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Menyimpan...';

          // Submit form
          setTimeout(() => {
            this.submit();
          }, 800);
        });
      }

      function showAlert(type, message) {
        // Remove existing alerts
        const existingAlerts = document.querySelectorAll('.custom-alert');
        existingAlerts.forEach(alert => alert.remove());

        // Create new alert
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} custom-alert alert-dismissible fade show mt-3`;
        alertDiv.innerHTML = `
          <i class="fa-solid ${type === 'warning' ? 'fa-exclamation-triangle' : 'fa-circle-exclamation'} me-2"></i>
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Insert after existing alerts
        const existingAlert = document.querySelector('.alert');
        if (existingAlert) {
          existingAlert.parentNode.insertBefore(alertDiv, existingAlert.nextSibling);
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
        
        textarea.form-control-sm:focus {
          border-color: #86b7fe;
          box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
      `;
      document.head.appendChild(style);

      // Auto-hide alerts after 5 seconds
      document.querySelectorAll('.alert-dismissible').forEach(alert => {
        setTimeout(() => {
          const bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        }, 5000);
      });
    });
  </script>
@endpush