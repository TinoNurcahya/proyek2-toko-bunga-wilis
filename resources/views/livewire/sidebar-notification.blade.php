<div class="nav-section">
    <h6 class="section-title text-uppercase mb-3">Notifikasi</h6>
    <div class="nav-links">
        <a href="{{ route('profile.notifikasi.edit') }}"
            class="sidebar-link {{ request()->routeIs('profile.notifikasi.edit') ? 'sidebar-active' : '' }}">
            <i class="fa-solid fa-bell me-2"></i>
            Notifikasi
            @if ($unreadCount > 0)
                <span class="badge bg-danger ms-2">{{ $unreadCount }}</span>
            @endif
        </a>
    </div>
</div>