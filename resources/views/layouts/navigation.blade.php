<!-- Navbar Start -->
<nav id="main-navbar" class="navbar navbar-expand-lg w-100 fw-medium fixed-top navbar-light montserrat">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img id="navbar-logo" src="{{ asset('images/logo-dark.png') }}" alt="Logo" class="me-2">
        </a>

        <!-- Toggler -->
        <button
            class="navbar-toggler 
            @if (auth()->check() && auth()->user()->hasVerifiedEmail()) border-dark
            @else border-white @endif"
            type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span
                class="navbar-toggler-icon 
                @if (auth()->check() && auth()->user()->hasVerifiedEmail()) custom-toggler-dark
                @else custom-toggler-light @endif">
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu Tengah + Search -->
            <ul class="navbar-nav me-auto ms-5 align-items-center montserrat">
                <li class="nav-item">
                    <a class="nav-link me-4 {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-4 {{ request()->is('produk') ? 'active' : '' }}"
                        href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-4 {{ request()->is('tentang') ? 'active' : '' }}"
                        href="{{ url('/tentang') }}">Tentang
                        Kami</a>
                </li>

                <!-- Search box disini -->
                <li class="nav-item">
                    <div class="search-box position-relative">
                        <input type="text" class="form-control bg-opacity-25 border-0 rounded-pill ps-3 pe-5"
                            placeholder="Cari...">
                        <i class="fas fa-search position-absolute end-0 me-3 top-50 translate-middle-y"></i>
                    </div>
                </li>
            </ul>

            <!-- Icons kanan -->
            <div class="d-flex align-items-center ms-lg-4 mt-3 mt-lg-0">
                <div class="nav-icons d-flex align-items-center">

                    <!-- Cart Icon dengan Conditional Behavior -->
                    @auth
                        @if (Auth::user()->hasVerifiedEmail())
                            <!-- Cart untuk user yang SUDAH VERIFIKASI -->
                            <div class="cart-hover-container position-relative me-3">
                                <a class="position-relative text-white text-decoration-none" href="#">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                                </a>
                                <div class="cart-popup position-absolute">
                                    <div class="p-3 text-center">
                                        <h6 class="dropdown-header">Keranjang Belanja</h6>
                                        <!-- Contoh item cart -->
                                        <div class="cart-item d-flex align-items-center py-2 border-bottom">
                                            <img src="{{ asset('images/monstera.jpg') }}" alt="Product" width="40"
                                                class="me-2 rounded">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 small">monstera</h6>
                                                <small class="text-muted">Rp 100.000 x 1</small>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider my-2"></div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong>Total:</strong>
                                            <strong>Rp 100.000</strong>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-sm w-100">Lihat Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Cart untuk user BELUM VERIFIKASI -->
                            <div class="cart-hover-container position-relative me-3">
                                <a class="text-white position-relative text-decoration-none" href="#"
                                    style="pointer-events: none;">
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

                    @auth
                        @if (Auth::user()->hasVerifiedEmail())
                            <!-- Notification Bell untuk SUDAH VERIFIKASI -->
                            <div class="notif-hover-container position-relative me-3">
                                <a class="text-white text-decoration-none position-relative" href="#">
                                    <i class="fas fa-bell"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                                </a>
                                <div class="notif-popup position-absolute">
                                    <div class="p-3 text-center">
                                        <i class="fas fa-bell text-black fa-2x text-muted mb-2"></i>
                                        <p class="mb-2 small">Notifikasi</p>
                                        <div class="d-flex justify-content-center gap-2 w-100 mt-2">
                                            <a href="#" class="btn btn-success w-100 disabled">Tidak ada notifikasi
                                                baru</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Notification untuk BELUM VERIFIKASI -->
                            <div class="notif-hover-container position-relative me-3">
                                <a class="text-white position-relative text-decoration-none" href="#"
                                    style="pointer-events: none;">
                                    <i class="fas fa-bell"></i>
                                </a>
                                <div class="notif-popup position-absolute">
                                    <div class="p-3 text-center">
                                        <i class="fas fa-bell fa-2x text-warning mb-2"></i>
                                        <p class="mb-2 small">Email belum terverifikasi</p>
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm w-100">Kirim Ulang
                                                Verifikasi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- Notification untuk guest -->
                        <div class="notif-hover-container position-relative me-3">
                            <a class="text-white position-relative text-decoration-none" href="{{ route('login') }}">
                                <i class="fas fa-bell"></i>
                            </a>
                            <div class="notif-popup position-absolute">
                                <div class="p-3 text-center">
                                    <i class="fas fa-bell fa-2x text-muted mb-2"></i>
                                    <p class="mb-2 small">Masuk untuk melihat notifikasi</p>
                                    <div class="d-flex justify-content-center gap-2 w-100 mt-2">
                                        <a href="{{ route('login') }}" class="btn btn-success w-100">Masuk</a>
                                        <a href="{{ route('register') }}"
                                            class="btn btn-outline-success w-100">Daftar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth



                    <!-- User dropdown untuk SUDAH VERIFIKASI -->
                    @auth
                        @if (Auth::user()->hasVerifiedEmail())
                            <div class="user-hover-container position-relative me-3">
                                <a class="text-white position-relative text-decoration-none"
                                    href="{{ route('profile.edit') }}">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="ms-2 text-white fw-semibold small">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="user-popup position-absolute">
                                    <div class="text-center">
                                        <ul>
                                            <li><a class="dropdown-item mt-3 fw-semibold"
                                                    href="{{ route('profile.edit') }}">Akun
                                                    saya</a>
                                            </li>
                                            <li><a class="dropdown-item fw-semibold"
                                                    href="{{ route('profile.edit') }}">Pesanan
                                                    saya</a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="dropdown-item fw-semibold">Keluar</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- User untuk BELUM VERIFIKASI -->
                            <div class="user-hover-container position-relative">
                                <a class="text-decoration-none d-flex align-items-center" href="#"
                                    style="pointer-events: none;">
                                    <div class="profile-icon d-flex align-items-center justify-content-center rounded-circle bg-warning border"
                                        style="width: 32px; height: 32px;">
                                        <i class="fas fa-envelope text-dark"></i>
                                    </div>
                                </a>
                                <div class="user-popup position-absolute">
                                    <div class="p-3 text-center">
                                        <i class="fas fa-envelope fa-2x text-warning mb-2"></i>
                                        <p class="mb-2 small">Email belum terverifikasi</p>
                                        <form method="POST" action="{{ route('verification.send') }}" class="mb-2">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm w-100">Kirim Ulang
                                                Verifikasi</button>
                                        </form>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item fw-semibold">Keluar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- User untuk guest -->
                        <div class="user-hover-container position-relative me-3">
                            <a class="text-white position-relative text-decoration-none" href="{{ route('login') }}">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <div class="user-popup position-absolute">
                                <div class="p-3 text-center">
                                    <i class="fa-solid fa-user fa-2x text-muted mb-2"></i>
                                    <p class="mb-2 small">Silakan Masuk Untuk Melanjutkan</p>
                                    <div class="d-flex justify-content-center gap-2 w-100 mt-2">
                                        <a href="{{ route('login') }}" class="btn btn-success w-100">Masuk</a>
                                        <a href="{{ route('register') }}"
                                            class="btn btn-outline-success w-100">Daftar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
