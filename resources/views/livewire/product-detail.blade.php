<div>
    {{-- Harga --}}
    <h3 class="text-success fw-bold mb-3 montserrat p-2" id="product-price">
        Rp {{ number_format($selectedPrice, 0, ',', '.') }}
    </h3>

    {{-- Pilihan Ukuran --}}
    <div class="mb-4 montserrat" id="size-selection">
        <p class="fw-semibold mb-3" id="size-label">Ukuran</p>
        <div class="d-flex gap-2 flex-wrap" id="size-options-container">
            @if ($produk->produkUkuran && $produk->produkUkuran->count() > 0)
                @foreach ($produk->produkUkuran as $produkUkuran)
                    <button 
                        class="btn btn-outline-success size-option text-nowrap {{ $produkUkuran->id_produk_ukuran == $selectedSizeId ? 'active' : '' }}"
                        wire:click="selectSize({{ $produkUkuran->id_produk_ukuran }}, {{ $produkUkuran->harga }}, {{ $produkUkuran->stok }})"
                        wire:key="size-{{ $produkUkuran->id_produk_ukuran }}">
                        {{ $produkUkuran->ukuran->nama_ukuran ?? ($produkUkuran->ukuran->nama ?? 'Ukuran') }}
                    </button>
                @endforeach
            @else
                <button class="btn btn-outline-success size-option active"
                    wire:click="selectSize(0, {{ $produk->harga_terendah }}, {{ $produk->stok_total ?? 0 }})">
                    Standard
                </button>
            @endif
        </div>
    </div>

    {{-- Kuantitas dan Stok --}}
    <div class="mb-4 montserrat" id="quantity-section">
        <p class="fw-bold mb-3" id="quantity-label">Kuantitas</p>
        <div class="d-flex align-items-center mb-4" id="quantity-controls">
            <button class="btn btn-outline-secondary" wire:click="updateQuantity(-1)" id="decrease-qty">−</button>
            <div class="mx-3 fs-5 fw-bold">{{ $quantity }}</div>
            <button class="btn btn-outline-secondary" wire:click="updateQuantity(1)" id="increase-qty">+</button>
            <span class="ms-3 text-muted small" id="stock-info">
                Stok: {{ $selectedStock }}
            </span>
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
                    <strong class="text-success fw-bold mb-0 text-decoration-underline">
                        Rp {{ number_format($selectedPrice * $quantity, 0, ',', '.') }}
                    </strong>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="d-flex gap-3 mb-4 montserrat" id="action-buttons">
        <button class="btn btn-outline-success flex-fill py-3" id="add-to-cart-btn"
            wire:click="addToCart"
            wire:loading.attr="disabled"
            {{-- UNTUK LOADING STATE --}}
            @if($addingToCart) disabled @endif>
            
            <i class="fa-solid fa-cart-plus me-2"></i>
            
            {{-- BERDASARKAN PROPERTY --}}
            @if(!$addingToCart)
                <span>Masukkan ke Keranjang</span>
            @else
                <span>
                    <i class="fas fa-spinner fa-spin me-2"></i>Menambahkan...
                </span>
            @endif
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