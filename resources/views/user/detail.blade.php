@extends('layouts.app')

@section('content')
    <div class="container my-5 mt-5" id="product-detail-page">
        {{-- Tombol kembali --}}
        <a href="{{ url('/produk') }}" class="btn btn-outline-success mb-4 mt-5" id="back-button">
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
                                <img src="{{ asset($foto->foto) }}" alt="{{ $produk->nama }}"
                                    class="img-thumbnail gallery-thumb"
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

                {{-- Harga --}}
                <h3 class="text-success fw-bold mb-3 montserrat p-2" id="product-price">
                    @if ($produk->produkUkuran && $produk->produkUkuran->count() > 0)
                        Rp {{ number_format($produk->produkUkuran->first()->harga, 0, ',', '.') }}
                    @elseif($produk->harga_terendah)
                        Rp {{ number_format($produk->harga_terendah, 0, ',', '.') }}
                    @else
                        Harga tidak tersedia
                    @endif
                </h3>

                {{-- Pilihan Ukuran --}}
                <div class="mb-4 montserrat" id="size-selection">
                    <p class="fw-semibold mb-3" id="size-label">Ukuran</p>
                    <div class="d-flex gap-2 flex-wrap" id="size-options-container">
                        @if ($produk->produkUkuran && $produk->produkUkuran->count() > 0)
                            @foreach ($produk->produkUkuran as $produkUkuran)
                                <button
                                    class="btn btn-outline-success size-option text-nowrap {{ $loop->first ? 'active' : '' }}"
                                    data-price="{{ $produkUkuran->harga }}" data-stock="{{ $produkUkuran->stok }}"
                                    data-ukuran-name="{{ $produkUkuran->ukuran->nama_ukuran ?? ($produkUkuran->ukuran->nama ?? 'Ukuran') }}">
                                    {{ $produkUkuran->ukuran->nama_ukuran ?? ($produkUkuran->ukuran->nama ?? 'Ukuran') }}
                                </button>
                            @endforeach
                        @else
                            <button class="btn btn-outline-success size-option active"
                                data-price="{{ $produk->harga_terendah }}" data-stock="{{ $produk->stok_total ?? 0 }}"
                                data-ukuran-name="Standard">
                                Standard
                            </button>
                        @endif
                    </div>
                </div>

                {{-- Kuantitas dan Stok --}}
                <div class="mb-4 montserrat" id="quantity-section">
                    <p class="fw-bold mb-3" id="quantity-label">Kuantitas</p>
                    <div class="d-flex align-items-center mb-4" id="quantity-controls">
                        <button class="btn btn-outline-secondary" onclick="changeQty(-1)" id="decrease-qty">−</button>
                        <div id="qty" class="mx-3 fs-5 fw-bold">1</div>
                        <button class="btn btn-outline-secondary" onclick="changeQty(1)" id="increase-qty">+</button>
                        <span class="ms-3 text-muted small" id="stock-info">Stok:
                            {{ $produk->produkUkuran->first()->stok ?? ($produk->stok_total ?? 0) }}</span>
                    </div>
                </div>

                {{-- Subtotal --}}
                <div class="card bg-light mb-4 montserrat" id="subtotal-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="fw-bold mb-0">Subtotal</p>
                            </div>
                            <div class="col-auto">
                                <strong id="subtotal" class="text-success fw-bold mb-0 text-decoration-underline">
                                    Rp {{ number_format($produk->harga_terendah ?? 0, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex gap-3 mb-4 montserrat" id="action-buttons">
                    <button class="btn btn-outline-success flex-fill py-3" id="add-to-cart-btn">
                        <i class="fa-solid fa-cart-plus me-2"></i>Masukkan ke Keranjang
                    </button>
                    <button class="btn btn-green text-light flex-fill py-3" id="buy-now-btn">
                        <i class="fas fa-bolt me-2"></i>Beli Sekarang
                    </button>
                </div>

                {{-- Info Penting --}}
                <div class="row text-center mb-4" id="feature-highlights">
                    <div class="col-md-3 col-6">
                        <div class="border rounded p-2 feature-item">
                            <i class="fas fa-shipping-fast text-success mb-2"></i>
                            <small class="d-block montserrat">Gratis Ongkir</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="border rounded py-2 px-0 feature-item">
                            <i class="fas fa-shield-alt text-success mb-2"></i>
                            <small class="d-block montserrat">Garansi 30 Hari</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="border rounded py-2 px-0 feature-item">
                            <i class="fas fa-undo text-success mb-2"></i>
                            <small class="d-block montserrat">Pengembalian</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="border rounded py-2 px-0 feature-item">
                            <i class="fas fa-headset text-success mb-2"></i>
                            <small class="d-block montserrat">Bantuan 24/7</small>
                        </div>
                    </div>
                </div>
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
                        <img id="modal-image" src="" alt="{{ $produk->nama }}"
                            class="img-fluid modal-image-content">
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
                                <button class="nav-link active fraunces" id="desc-tab" data-bs-toggle="tab"
                                    data-bs-target="#desc" type="button">
                                    Deskripsi Produk
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fraunces" id="detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#detail" type="button">
                                    Detail Tanaman
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fraunces" id="care-tab" data-bs-toggle="tab"
                                    data-bs-target="#care" type="button">
                                    Petunjuk Perawatan
                                </button>
                            </li>
                            @if ($produk->fotoProduk && $produk->fotoProduk->count() > 0)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fraunces" id="gallery-tab" data-bs-toggle="tab"
                                        data-bs-target="#gallery" type="button">
                                        Gallery Foto
                                    </button>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content border border-top-0 p-4 rounded-bottom" id="productTabContent">
                            {{-- Tab Deskripsi --}}
                            <div class="tab-pane fade show active" id="desc" role="tabpanel">
                                <p class="small mb-0 montserrat">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
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
                                                    data-bs-target="#imageModal"
                                                    onclick="setModalImage('{{ asset($produk->foto_utama) }}')">
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
                                                        data-bs-target="#imageModal"
                                                        onclick="setModalImage('{{ asset($foto->foto) }}')">
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
                                    <div
                                        class="d-flex align-items-center justify-content-between mb-3 montserrat related-product-stats">
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

        // Fungsi untuk quantity
        function changeQty(change) {
            const qtyElement = document.getElementById('qty');
            let qty = parseInt(qtyElement.textContent);
            const newQty = qty + change;

            // Validasi stok
            const stockInfo = document.getElementById('stock-info');
            const availableStock = parseInt(stockInfo.textContent.replace('Stok: ', ''));

            if (newQty >= 1 && newQty <= availableStock) {
                qtyElement.textContent = newQty;
                updateSubtotal();
            }
        }

        // Fungsi untuk update subtotal
        function updateSubtotal() {
            const qty = parseInt(document.getElementById('qty').textContent);
            const activeSize = document.querySelector('.size-option.active');
            const price = activeSize ? parseInt(activeSize.dataset.price) : {{ $produk->harga_terendah ?? 0 }};
            const subtotal = qty * price;

            document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        }

        // Fungsi untuk inisialisasi ukuran default
        function initializeDefaultSize() {
            const defaultSize = document.querySelector('.size-option.active');
            if (defaultSize) {
                const price = defaultSize.dataset.price;
                const stock = defaultSize.dataset.stock;
                document.getElementById('product-price').textContent = 'Rp ' + parseInt(price).toLocaleString('id-ID');
                document.getElementById('stock-info').textContent = 'Stok: ' + stock;
                updateSubtotal();
            }
        }

        // Fungsi untuk inisialisasi modal image
        function initializeModalImage() {
            const mainImage = document.getElementById('main-image');
            const modalImage = document.getElementById('modal-image');

            if (mainImage && modalImage) {
                modalImage.src = mainImage.src;
            }
        }

        // Event listener untuk pilihan ukuran
        function initializeSizeOptions() {
            document.querySelectorAll('.size-option').forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class dari semua button
                    document.querySelectorAll('.size-option').forEach(btn => {
                        btn.classList.remove('active');
                    });

                    // Add active class ke button yang diklik
                    this.classList.add('active');

                    // Update harga
                    const price = this.dataset.price;
                    document.getElementById('product-price').textContent = 'Rp ' + parseInt(price)
                        .toLocaleString('id-ID');

                    // Update stok info
                    document.getElementById('stock-info').textContent = 'Stok: ' + this.dataset.stock;

                    // Reset quantity ke 1
                    document.getElementById('qty').textContent = '1';

                    // Update subtotal
                    updateSubtotal();
                });
            });
        }

        // Event listener untuk main image click (buka modal)
        function initializeImageModal() {
            const mainImage = document.getElementById('main-image');
            if (mainImage) {
                mainImage.addEventListener('click', function() {
                    setModalImage(this.src);
                });
            }

            // Juga untuk gallery images di tab gallery
            document.querySelectorAll('.gallery-image').forEach(img => {
                img.addEventListener('click', function() {
                    setModalImage(this.src);
                });
            });
        }

        // Inisialisasi semua fungsi ketika DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            initializeSizeOptions();
            initializeDefaultSize();
            initializeModalImage();
            initializeImageModal();

            // Juga set modal image saat thumbnail diklik
            document.querySelectorAll('.gallery-thumb').forEach(thumb => {
                thumb.addEventListener('click', function() {
                    const imageSrc = this.src;
                    setModalImage(imageSrc);
                });
            });
        });

        window.addEventListener('load', function() {
            initializeDefaultSize();
            initializeModalImage();
        });
    </script>
@endsection
