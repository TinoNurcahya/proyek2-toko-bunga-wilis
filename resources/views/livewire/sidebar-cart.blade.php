<div class="nav-section border border-1 border-light pb-1 mb-3">
    <h6 class="section-title text-uppercase mb-3">Belanja</h6>
    <div class="nav-links">
        <a href="{{ route('profile.keranjang') }}"
            class="sidebar-link {{ request()->routeIs('profile.keranjang') ? 'sidebar-active' : '' }}">
            <i class="fa-solid fa-shopping-cart me-2"></i>
            Keranjang
            @php
                $cartCount = \App\Models\Keranjang::where('id_users', auth()->id())->count();
            @endphp
            @if ($cartCount > 0)
                <span class="badge bg-success ms-2">{{ $cartCount }}</span>
            @endif
        </a>
    </div>
</div>
