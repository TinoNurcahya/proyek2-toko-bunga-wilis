<div class="testimonial-swiper mx-auto" style="max-width: 600px;" wire:poll.60s="refreshTestimonials" wire:ignore>
    <h3 class="fw-semibold mb-1 position-relative d-inline-block fraunces" data-aos="fade-down">
        Apa yang orang katakan
    </h3>

    <div class="testimonial-container position-relative" data-aos="fade-down">
        <div class="swiper testimonialSwiper">
            <div class="swiper-wrapper">
                @if ($testimonials->count() > 0)
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card card shadow-md border-1 h-100">
                                <div class="card-body text-start p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        @if ($testimonial->user && $testimonial->user->foto_profil)
                                            <img src="{{ asset('storage/' . $testimonial->user->foto_profil) }}"
                                                alt="{{ $testimonial->user->nama }}" class="rounded-circle me-3"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <i class="fa-solid fa-user-circle fa-2x text-success me-3"></i>
                                        @endif
                                        <div class="overflow-auto">
                                            <strong class="montserrat d-block">
                                                {{ $testimonial->user ? $testimonial->user->nama : 'User Tidak Ditemukan' }}
                                            </strong>
                                            @if ($testimonial->produk)
                                                <small class="text-muted montserrat d-block">
                                                    Beli: {{ $testimonial->produk->nama }}
                                                </small>
                                            @endif
                                            <span class="text-warning">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fa-solid fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                                                @endfor
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0 small montserrat">
                                        "{{ $testimonial->komentar }}"
                                    </p>
                                    <small class="text-muted mt-2 d-block">
                                        {{ \Carbon\Carbon::parse($testimonial->tanggal_review)->locale('id')->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback testimonial -->
                    <div class="swiper-slide">
                        <div class="testimonial-card card shadow-md border-0 h-100">
                            <div class="card-body text-start p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fa-solid fa-user-circle fa-2x text-success me-3"></i>
                                    <div>
                                        <strong class="montserrat">Pengguna</strong>
                                        <br>
                                        <span class="text-warning">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                    </div>
                                </div>
                                <p class="text-muted mb-0 small montserrat">
                                    "Saya beli tanaman berbunga, warnanya cantik dan bikin kamar lebih hidup.
                                    Informasi tanamannya jelas, jadi mudah dirawat."
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>

        <!-- Add Navigation -->
        <div class="testimonial-button-next d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-chevron-right"></i>
        </div>
        <div class="testimonial-button-prev d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
    </div>
</div>
