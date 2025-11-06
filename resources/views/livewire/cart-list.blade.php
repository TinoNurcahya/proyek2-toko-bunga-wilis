<div>
    <!-- Header Mobile -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h2 class="h5 fw-bold text-dark mb-1">{{ __('Keranjang Belanja') }}</h2>
                <p class="small text-muted mb-0 d-none d-md-block">
                    {{ __('Kelola produk dalam keranjang belanja Anda.') }}
                </p>
            </div>
            @if ($cartItems->count() > 0)
                <div class="text-end">
                    <span class="badge bg-success mb-1">
                        {{ $cartItems->count() }} item
                    </span>
                    <div class="fw-bold text-success small">
                        Total: Rp <span id="total-price-amount">{{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endif
        </div>
        <p class="small text-muted mb-0 d-md-none">
            {{ __('Kelola produk dalam keranjang belanja Anda.') }}
        </p>
    </div>

    @if ($cartItems->count() > 0)
        <!-- Mobile View  -->
        <div class="d-md-none">
            @foreach ($cartItems as $item)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <!-- Product Image and Basic Info -->
                        <div class="d-flex align-items-start mb-2">
                            @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->foto_utama)
                                <img src="{{ asset($item->produkUkuran->produk->foto_utama) }}"
                                    alt="{{ $item->produkUkuran->produk->nama }}" width="70" height="70"
                                    class="me-3 rounded object-fit-cover flex-shrink-0">
                            @else
                                <img src="{{ asset('images/default-product.png') }}" alt="Default Product"
                                    width="70" height="70" class="me-3 rounded object-fit-cover flex-shrink-0">
                            @endif

                            <div class="flex-grow-1">
                                <h6 class="fw-semibold mb-1 text-dark small">
                                    {{ $item->produkUkuran && $item->produkUkuran->produk ? $item->produkUkuran->produk->nama : 'Produk tidak tersedia' }}
                                </h6>

                                @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->detailTanaman)
                                    <p class="small text-muted mb-1">
                                        <em>{{ $item->produkUkuran->produk->detailTanaman->nama_ilmiah }}</em>
                                    </p>
                                @endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold small">
                                        Rp
                                        {{ $item->produkUkuran ? number_format($item->produkUkuran->harga, 0, ',', '.') : '0' }}
                                    </span>
                                    <button wire:click="deleteItem({{ $item->id_keranjang }})"
                                        wire:confirm="Hapus produk dari keranjang?"
                                        class="btn btn-sm btn-outline-danger p-1" title="Hapus dari keranjang">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Size and Quantity -->
                        <div class="row g-2">
                            @if ($item->produkUkuran && $item->produkUkuran->ukuran)
                                <div class="col-6">
                                    <span class="small text-muted d-block mb-1">Ukuran:</span>
                                    <div class="btn-group btn-group-sm w-100" role="group">
                                        <button type="button" class="btn btn-outline-secondary active small">
                                            {{ $item->produkUkuran->ukuran->nama_ukuran }}
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <div class="col-6">
                                <span class="small text-muted d-block mb-1">Kuantitas:</span>
                                <div class="btn-group btn-group-sm w-100" role="group">
                                    <button type="button" class="btn btn-outline-secondary p-1"
                                        wire:click="updateQuantity({{ $item->id_keranjang }}, -1)"
                                        {{ $item->jumlah <= 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-minus fa-xs"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary disabled p-1 small">
                                        <span>{{ $item->jumlah }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary p-1"
                                        wire:click="updateQuantity({{ $item->id_keranjang }}, 1)"
                                        {{ $item->produkUkuran && $item->jumlah >= $item->produkUkuran->stok ? 'disabled' : '' }}>
                                        <i class="fas fa-plus fa-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Subtotal -->
                        <div class="mt-2 pt-2 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted">Subtotal:</span>
                                <strong class="text-dark small">
                                    Rp
                                    {{ number_format(($item->produkUkuran ? $item->produkUkuran->harga : 0) * $item->jumlah, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Mobile Order Summary-->
            <div class="bg-white border-top shadow-lg mt-3">
                <div class="p-3">
                    @php
                        $pajak = $totalPrice * 0.11;
                        $totalAkhir = $totalPrice + $pajak;
                    @endphp

                    <!-- Ringkasan Singkat -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="small text-muted">Total Pembayaran</div>
                            <div class="fw-bold text-success h6 mb-0">
                                Rp {{ number_format($totalAkhir, 0, ',', '.') }}
                            </div>
                            <div class="small text-muted">
                                Termasuk pajak 11% (Rp {{ number_format($pajak, 0, ',', '.') }})
                            </div>
                        </div>
                        <a href="#" class="btn btn-success flex-shrink-0 ms-2">
                            Checkout
                        </a>
                    </div>

                    <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 mt-2 small">
                        Lanjutkan Belanja
                    </a>
                </div>
            </div>
        </div>

        <!-- Desktop View -->
        <div class="d-none d-md-block">
            <div class="row">
                <!-- Daftar Produk -->
                <div class="col-md-8">
                    <div class="list-group">
                        @foreach ($cartItems as $item)
                            <div class="list-group-item list-group-item-action mb-3 rounded">
                                <div class="d-flex align-items-start">
                                    <!-- Gambar Produk -->
                                    @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->foto_utama)
                                        <img src="{{ asset($item->produkUkuran->produk->foto_utama) }}"
                                            alt="{{ $item->produkUkuran->produk->nama }}" width="100" height="100"
                                            class="me-3 rounded object-fit-cover flex-shrink-0">
                                    @else
                                        <img src="{{ asset('images/default-product.png') }}" alt="Default Product"
                                            width="100" height="100"
                                            class="me-3 rounded object-fit-cover flex-shrink-0">
                                    @endif

                                    <!-- Detail Produk -->
                                    <div class="flex-grow-1">
                                        <!-- Nama Produk dan Harga -->
                                        <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap">
                                            <h6 class="fw-semibold mb-0 text-break me-3"
                                                style="flex: 1 1 200px; min-width: 0;">
                                                {{ $item->produkUkuran && $item->produkUkuran->produk ? $item->produkUkuran->produk->nama : 'Produk tidak tersedia' }}
                                            </h6>
                                            <span class="text-success fw-bold flex-shrink-0 mt-1 mt-sm-0">
                                                Rp
                                                {{ $item->produkUkuran ? number_format($item->produkUkuran->harga, 0, ',', '.') : '0' }}
                                            </span>
                                        </div>

                                        <!-- Nama Ilmiah -->
                                        @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->detailTanaman)
                                            <p class="small text-muted mb-1">
                                                <em>{{ $item->produkUkuran->produk->detailTanaman->nama_ilmiah }}</em>
                                            </p>
                                        @endif

                                        <!-- Ukuran -->
                                        @if ($item->produkUkuran && $item->produkUkuran->ukuran)
                                            <div class="mb-3">
                                                <span class="small text-muted d-block mb-1">Ukuran:</span>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-outline-secondary active">
                                                        {{ $item->produkUkuran->ukuran->nama_ukuran }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Kuantitas dan Aksi -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <span class="small text-muted me-2">Kuantitas:</span>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        wire:click="updateQuantity({{ $item->id_keranjang }}, -1)"
                                                        {{ $item->jumlah <= 1 ? 'disabled' : '' }}>
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary disabled">
                                                        <span>{{ $item->jumlah }}</span>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        wire:click="updateQuantity({{ $item->id_keranjang }}, 1)"
                                                        {{ $item->produkUkuran && $item->jumlah >= $item->produkUkuran->stok ? 'disabled' : '' }}>
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Subtotal dan Hapus -->
                                            <div class="d-flex align-items-center">
                                                <strong class="text-dark me-3">
                                                    Subtotal: Rp
                                                    <span>{{ number_format(($item->produkUkuran ? $item->produkUkuran->harga : 0) * $item->jumlah, 0, ',', '.') }}</span>
                                                </strong>
                                                <button wire:click="deleteItem({{ $item->id_keranjang }})"
                                                    wire:confirm="Hapus produk dari keranjang?"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus dari keranjang">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="col-md-4">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Ringkasan pesanan</h6>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Sub-total</span>
                                <span class="fw-bold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Pengiriman</span>
                                <span class="text-success">Gratis</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Pajak</span>
                                <span>11%</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold text-success">Rp
                                    {{ number_format($totalAkhir, 0, ',', '.') }}</span>
                            </div>

                            <!-- Tombol Checkout -->
                            <a href="#" class="btn btn-success w-100 mb-2">
                                Checkout
                            </a>

                            <!-- Tombol Lanjutkan Belanja -->
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">
                                Lanjutkan Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Keranjang Kosong -->
        <div class="text-center py-4">
            <img src="{{ asset('images/empty-cart.svg') }}" class="img-fluid w-75 w-md-50 mb-3"
                alt="Keranjang kosong" style="max-height: 200px;">
            <h5 class="text-muted fw-bold mb-3">Keranjang belanja kosong</h5>
            <p class="text-muted small mx-auto mb-4 px-3" style="max-width: 400px;">
                Sepertinya anda belum menambahkan tanaman apa pun ke keranjang. Temukan koleksi
                tanaman cantik kami dan temukan tanaman hijau yang sempurna untuk anda.
            </p>
            <a href="{{ url('/') }}" class="btn btn-green text-white">
                <i class="fas fa-shopping-cart me-1"></i> Mulai Belanja
            </a>
        </div>
    @endif
</div>
