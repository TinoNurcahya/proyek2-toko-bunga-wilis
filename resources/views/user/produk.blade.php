@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    {{-- Hero section --}}
    <section id="hero" class="text-white d-flex align-items-center justify-content-center daunbg">
        <div class="text-center montserrat parallax col-lg-6 z-2" data-rellax-speed="-3">
            <h1 class="fraunces mb-3" data-aos="fade-down">Temukan Tanaman Favoritmu</h1>
            <p class="montserrat mb-2" data-aos="fade-right">
                Jelajahi koleksi tanaman segar, bunga hias, dan perlengkapan berkebun. Temukan produk favoritmu dan
                percantik rumah dengan mudah.
            </p>
            <p class="montserrat mb-4" data-aos="fade-left">
                Temukan tanaman cantik yang sesuai dengan rumahmu. Pilih, klik, dan nikmati keindahan alam di rumahmu
                sendiri.
            </p>
        </div>

        <div class="img-paralax-hero">
            <img id="tanamanhero" src="{{ asset('images/default/tanamanhero1.png') }}" class="parallax"
                data-rellax-speed="-6" alt="">
            <img id="tanamanhero-2" src="{{ asset('images/default/tanamanhero1.png') }}" class="parallax"
                data-rellax-speed="-6" alt="">
            <img id="tanamanhero-3" src="{{ asset('images/default/tanamanhero2.png') }}" class="parallax"
                data-rellax-speed="-7" alt="">
            <img id="tanamanhero-4" src="{{ asset('images/default/tanamanhero2.png') }}" class="parallax"
                data-rellax-speed="-7" alt="">
        </div>

        <div class="wave z-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <defs>
                    <linearGradient id="waveGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#f8f9fa" stop-opacity="0" />
                        <stop offset="40%" stop-color="#f8f9fa" stop-opacity="0.3" />
                        <stop offset="70%" stop-color="#f8f9fa" stop-opacity="0.7" />
                        <stop offset="100%" stop-color="#f8f9fa" stop-opacity="1" />
                    </linearGradient>
                </defs>
                <path fill="url(#waveGradient)"
                    d="M0,224L60,234.7C120,245,240,267,360,282.7C480,299,600,309,720,288C840,267,960,213,1080,192C1200,171,1320,181,1380,186.7L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>

    {{-- Produk Section --}}
    <section id="produk" class="py-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h3 class="fw-semibold mb-1 position-relative d-inline-block fraunces" data-aos="fade-right">Semua
                        Produk</h3>
                    <span class="montserrat text-muted" id="product-count" data-aos="fade-left">{{ $produk->count() }}
                        produk</span>
                </div>
            </div>
            {{-- Tombol Filter Mobile --}}
            <div class="d-md-none mb-3 z-3" data-aos="fade-down">
                <button class="btn btn-outline-success w-100" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>

            <div class="offcanvas offcanvas-bottom" tabindex="-1" id="filterOffcanvas" style="height: 48vh;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Filter Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="filter-bar d-flex flex-wrap align-items-center justify-content-center gap-3">
                        @include('user.partials.filter-bar')
                    </div>
                </div>
            </div>


            {{-- FILTER BAR HORIZONTAL --}}
            <div class="row">
                <div class="col-12">
                    <div
                        class="filter-bar d-none d-md-flex flex-wrap align-items-center gap-3 mb-4 p-3 bg-white rounded shadow-sm">
                        @include('user.partials.filter-bar')
                    </div>
                </div>
            </div>


            {{-- Grid Produk --}}
            <div class="row g-4" id="product-container">
                @foreach ($produk as $item)
                    @php
                        $totalStok = $item->produkUkuran ? $item->produkUkuran->sum('stok') : 0;
                    @endphp

                    <div class="col-6 col-md-4 col-lg-3 product-card" data-aos="fade-up" data-aos-duration="700"
                        data-aos-offset="50" data-category="{{ $item->id_kategori }}"
                        data-price="{{ $item->harga_terendah }}" data-size="{{ $item->ukuran ?? 'all' }}"
                        data-date="{{ $item->created_at }}" data-rating="{{ $item->rating ?? 0 }}"
                        data-sold="{{ $item->terjual ?? 0 }}" data-name="{{ strtolower($item->nama) }}"
                        data-stok="{{ $totalStok }}">
                        <div class="card h-100 border-0 shadow-sm product-item">
                            <div class="position-relative">
                                <img src="{{ asset($item->foto_utama) }}" alt="{{ $item->nama }}"
                                    class="card-img-top rounded-top-3" style="height: 180px; object-fit: cover;"
                                    loading="lazy">

                                {{-- Tampilkan Stok Habis hanya jika total stok benar-benar 0 --}}
                                @if ($totalStok <= 0)
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-light bg-opacity-75 d-flex align-items-center justify-content-center rounded-top-3">
                                        <span class="badge bg-danger montserrat fs-6 p-2">Stok Habis</span>
                                    </div>
                                    {{-- Tampilkan badge Stok Menipis jika stok kurang dari 10 --}}
                                @elseif($totalStok < 10)
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-warning text-dark montserrat">Stok Menipis:
                                            {{ $totalStok }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fraunces mb-1">{{ \Illuminate\Support\Str::limit($item->nama, 40) }}
                                </h6>
                                <p class="card-text montserrat mb-0 text-success fw-semibold">
                                    RP{{ number_format($item->harga_terendah, 0, ',', '.') }}
                                </p>

                                <div class="d-flex align-items-center justify-content-between mb-3 montserrat">
                                    <div class="d-flex align-items-center">
                                        <span class="text-warning me-1">
                                            <i class="fas fa-star"></i>
                                        </span>
                                        <small class="text-muted">{{ number_format($item->rating ?? 0, 1) }}</small>
                                    </div>
                                    <small class="text-muted">{{ $item->terjual_formatted ?? ($item->terjual ?? 0) }}
                                        terjual</small>
                                </div>

                                {{-- Tombol Lihat Detail --}}
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

                                {{-- Info Stok --}}
                                @if ($totalStok > 0)
                                    <small class="text-muted montserrat mt-2 text-center">
                                        Stok Tersedia: {{ $totalStok }}
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            <div id="no-products" class="text-center py-5 d-none">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h5 class="fraunces text-muted">Produk tidak ditemukan</h5>
                <p class="montserrat text-muted">Coba ubah filter pencarian Anda</p>
            </div>
        </div>
    </section>
@endsection
