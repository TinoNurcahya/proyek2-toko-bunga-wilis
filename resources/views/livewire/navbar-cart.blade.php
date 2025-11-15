@auth
    @if (Auth::user()->hasVerifiedEmail())
        <!-- Cart untuk user yang SUDAH VERIFIKASI -->
        <div class="cart-hover-container position-relative me-3">
            <a class="position-relative text-white text-decoration-none" href="{{ route('profile.keranjang') }}">
                <i class="fas fa-shopping-cart"></i>
                @php
                    $cartCount = \App\Models\Keranjang::where('id_users', auth()->id())->count();
                @endphp
                @if ($cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <div class="cart-popup position-absolute border border-success">
                <div class="p-3">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-shopping-cart text-success fa-lg me-2"></i>
                        <h6 class="mb-0 fw-bold text-left">Keranjang Belanja</h6>
                    </div>

                    @if ($cartItems->count() > 0)
                        <div class="cart-items-list" style="max-height: 200px; overflow-y: auto;">
                            @foreach ($cartItems as $cartItem)
                                <div class="cart-item d-flex align-items-start py-2 border-bottom">
                                    <!-- Gambar Produk -->
                                    @if ($cartItem->produkUkuran && $cartItem->produkUkuran->produk && $cartItem->produkUkuran->produk->foto_utama)
                                        <img src="{{ asset($cartItem->produkUkuran->produk->foto_utama) }}"
                                            alt="{{ $cartItem->produkUkuran->produk->nama }}" width="50" height="50"
                                            class="me-3 rounded object-fit-cover flex-shrink-0">
                                    @else
                                        <img src="{{ asset('images/default/default-product.jpg') }}" alt="Default Product"
                                            width="50" height="50"
                                            class="me-3 rounded object-fit-cover flex-shrink-0">
                                    @endif

                                    <!-- Detail Produk -->
                                    <div class="flex-grow-1" style="min-width: 0;">
                                        <!-- Nama Produk -->
                                        <h6 class="mb-1 fw-semibold text-truncate">
                                            {{ $cartItem->produkUkuran && $cartItem->produkUkuran->produk
                                                ? Str::limit($cartItem->produkUkuran->produk->nama, 18)
                                                : 'Produk tidak tersedia' }}
                                        </h6>

                                        <!-- Nama Ilmiah -->
                                        @if ($cartItem->produkUkuran && $cartItem->produkUkuran->produk && $cartItem->produkUkuran->produk->detailTanaman)
                                            <p class="mb-1 small text-muted">
                                                <em>{{ $cartItem->produkUkuran->produk->detailTanaman->nama_ilmiah }}</em>
                                            </p>
                                        @else
                                            <p class="mb-1 x-small text-muted">
                                                <em>Nama ilmiah tidak tersedia</em>
                                            </p>
                                        @endif

                                        <!-- Ukuran -->
                                        @if ($cartItem->produkUkuran && $cartItem->produkUkuran->ukuran)
                                            <p class="mb-1 small text-muted">
                                                Ukuran:
                                                {{ $cartItem->produkUkuran->ukuran->nama_ukuran }}
                                            </p>
                                        @endif

                                        <!-- Harga dan Quantity -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-success fw-bold">
                                                Rp
                                                {{ $cartItem->produkUkuran ? number_format($cartItem->produkUkuran->harga, 0, ',', '.') : '0' }}
                                            </small>
                                            <small class="text-muted">
                                                x{{ $cartItem->jumlah }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="dropdown-divider my-2"></div>
                        @if ($cartCount > 0)
                            @php
                                $otherItemsCount = max(0, $cartCount - $cartItems->count());
                            @endphp

                            <div class="dropdown-divider my-2"></div>
                            <div class="text-center mb-2">
                                <small class="text-muted">
                                    + {{ $otherItemsCount }} produk {{ $otherItemsCount != 1 ? 'lainnya' : 'lain' }}
                                </small>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-shopping-cart text-muted fa-2x mb-2"></i>
                            <p class="mb-0 small text-muted">Keranjang belanja kosong</p>
                        </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('profile.keranjang') }}" class="btn btn-success btn-sm w-100">
                            <i class="fas fa-shopping-cart me-1" style="color: white"></i>
                            Lihat Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Cart untuk user BELUM VERIFIKASI -->
        <div class="cart-hover-container position-relative me-3">
            <a class="text-white position-relative text-decoration-none" href="#" style="pointer-events: none;">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <div class="cart-popup position-absolute">
                <div class="p-3 text-center">
                    <i class="fas fa-shopping-cart fa-2x text-warning mb-2"></i>
                    <p class="mb-2 small">Email belum terverifikasi</p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">Kirim Ulang
                            Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@else
    <!-- Cart untuk guest -->
    <div class="cart-hover-container position-relative me-3">
        <a class="text-white position-relative text-decoration-none" href="{{ route('login') }}">
            <i class="fas fa-shopping-cart"></i>
        </a>
        <div class="cart-popup position-absolute">
            <div class="p-3 text-center">
                <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i>
                <p class="mb-2 small">Masuk untuk melihat keranjang</p>
                <div class="d-flex justify-content-center gap-2 w-100 mt-2">
                    <a href="{{ route('login') }}" class="btn btn-success w-100">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success w-100">Daftar</a>
                </div>
            </div>
        </div>
    </div>
@endauth
