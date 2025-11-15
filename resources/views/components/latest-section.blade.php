@props(['produkItem'])

<section class="text-center pt-4 home-section-title">
    <div class="container">
        <h3 class="fw-semibold mb-1 position-relative d-inline-block fraunces">Terbaru</h3>
        <p class="text-muted montserrat">Jangan lewatkan item baru yang baru ditambahkan</p>

        @if (isset($produkItem) && $produkItem->count() > 0)
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($produkItem as $item)
                        <div class="swiper-slide card">
                            <div class="card-image">
                                @if ($item->foto_utama)
                                    <img src="{{ asset($item->foto_utama) }}" alt="{{ $item->nama }}">
                                @else
                                    <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $item->nama }}">
                                @endif
                                <span class="card-tag montserrat">
                                    Baru
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>

                                @if ($item->rating > 0)
                                    <div class="rating-badge montserrat">
                                        ⭐ {{ number_format($item->rating, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-content">
                                <h4 class="card-title fraunces ">{{ $item->nama }}</h4>
                                <p class="card-text montserrat">
                                    {{ $item->deskripsi ? substr($item->deskripsi, 0, 100) . '...' : 'Deskripsi tidak tersedia' }}
                                </p>

                                <div class="product-info montserrat">
                                    @if ($item->terjual > 0)
                                        <span class="sold-count">Terjual: {{ $item->terjual_formatted }}</span>
                                    @endif
                                    @if ($item->produkUkuran->count() > 0)
                                        <!-- Tampilkan range harga -->
                                        @php
                                            $hargaTerendah = $item->produkUkuran->min('harga');
                                            $hargaTertinggi = $item->produkUkuran->max('harga');
                                        @endphp

                                        @if ($hargaTerendah == $hargaTertinggi)
                                            <span class="harga">Rp
                                                {{ number_format($hargaTerendah, 0, ',', '.') }}</span>
                                        @else
                                            <span class="harga">
                                                Rp {{ number_format($hargaTerendah, 0, ',', '.') }} -
                                                Rp {{ number_format($hargaTertinggi, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="harga">Harga tidak tersedia</span>
                                    @endif
                                </div>

                                <div class="card-footer montserrat">
                                    <a href="{{ route('produk.detail', $item->id_produk) }}" class="card-button">Beli
                                        Sekarang</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        @else
            <div class="alert alert-info">
                <p>Tidak ada produk terbaru saat ini.</p>
            </div>
        @endif
    </div>
</section>
