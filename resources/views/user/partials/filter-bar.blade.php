{{-- Filter Bar Component --}}
<div class="dropdown">
    <button class="btn btn-outline-secondary dropdown-toggle montserrat dropdown-kategori" type="button"
        data-bs-toggle="dropdown">
        <i class="fas fa-layer-group me-1 text-primary"></i> Kategori
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item category-option active" data-value="all">Semua Kategori</a></li>
        <li><a class="dropdown-item category-option" data-value="1">Indoor Plants</a></li>
        <li><a class="dropdown-item category-option" data-value="2">Outdoor Plants</a></li>

        @foreach ($kategories as $kategori)
            @if ($kategori->id_kategori != 1 && $kategori->id_kategori != 2)
                <li><a class="dropdown-item category-option"
                        data-value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a>
                </li>
            @endif
        @endforeach
    </ul>
</div>

<div class="dropdown">
    <button class="btn btn-outline-secondary dropdown-toggle montserrat dropdown-sort" type="button"
        data-bs-toggle="dropdown">
        <i class="fas fa-sort me-1 text-success"></i> Terbaru
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item sort-option active" data-value="terbaru">Terbaru</a></li>
        <li><a class="dropdown-item sort-option" data-value="terlama">Terlama</a></li>
        <li><a class="dropdown-item sort-option" data-value="rating_tertinggi">Rating Tertinggi</a></li>
    </ul>
</div>

<div class="dropdown">
    <button class="btn btn-outline-secondary dropdown-toggle montserrat dropdown-harga" type="button"
        data-bs-toggle="dropdown">
        <i class="fas fa-tag me-1 text-warning"></i> Harga
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item price-option active" data-value="all">Semua Harga</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li><a class="dropdown-item price-option" data-value="harga_terendah">Harga Terendah</a></li>
        <li><a class="dropdown-item price-option" data-value="harga_tertinggi">Harga Tertinggi</a></li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li><a class="dropdown-item price-option" data-value="0-50000">&lt; Rp50.000</a></li>
        <li><a class="dropdown-item price-option" data-value="50000-100000">Rp50.000 - Rp100.000</a></li>
        <li><a class="dropdown-item price-option" data-value="100000-200000">Rp100.000 - Rp200.000</a></li>
        <li><a class="dropdown-item price-option" data-value="200000-9999999">&gt; Rp200.000</a></li>
    </ul>
</div>

<div class="dropdown">
    <button class="btn btn-outline-secondary dropdown-toggle montserrat dropdown-terlaris" type="button"
        data-bs-toggle="dropdown">
        <i class="fas fa-fire me-1 text-danger"></i> Terlaris
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item terlaris-option active" data-value="all">Semua</a></li>
        <li><a class="dropdown-item terlaris-option" data-value="10">10+ terjual</a></li>
        <li><a class="dropdown-item terlaris-option" data-value="20">20+ terjual</a></li>
        <li><a class="dropdown-item terlaris-option" data-value="50">50+ terjual</a></li>
    </ul>
</div>

{{-- Search --}}
<div class="flex-grow-1 ms-md-auto" style="max-width: 300px;" data-aos="fade-left">
    <div class="input-group">
        <input type="text" class="form-control border-start-0 search-input" placeholder="Cari produk..."
            value="{{ request('search') }}">
        <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-search text-muted"></i>
        </span>
    </div>
</div>

<button class="btn btn-outline-danger montserrat reset-filters" data-aos="fade-left">
    <i class="fas fa-refresh me-1"></i> Reset
</button>
