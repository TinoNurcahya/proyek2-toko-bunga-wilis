<div class="sidebar-nav bg-white p-5 rounded shadow-sm position-sticky">
  <!-- Profile Info -->
  <div class="text-center border border-1 border-light mb-4 pb-4">
    @if ($user->foto_profil)
      <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="profile-image rounded-circle mb-3">
    @else
      <img src="{{ asset('images/default/default-avatar.png') }}" alt="Foto Profil Default"
        class="profile-image rounded-circle mb-3">
    @endif
    <h5 class="profile-name fw-bold text-dark mb-1 overflow-x-auto"> {{ $user->nama }}</h5>
  </div>

  <!-- Navigation -->
  <div class="nav-section border border-1 border-light pb-1 mb-3">
    <h6 class="section-title text-uppercase mb-3">Akun Saya</h6>
    <div class="nav-links">
      <a href="{{ route('profile.edit') }}"
        class="sidebar-link {{ request()->routeIs('profile.edit') ? 'sidebar-active' : '' }}">
        <i class="fa-solid fa-user me-2"></i>
        Profil
      </a>
      <a href="{{ route('profile.alamat.edit') }}"
        class="sidebar-link {{ request()->routeIs('profile.alamat.edit') ? 'sidebar-active' : '' }}">
        <i class="fa-solid fa-location-dot me-2"></i>
        Alamat
      </a>
    </div>
  </div>

  @livewire('sidebar-cart')


  <div class="nav-section border border-1 border-light pb-1 mb-3">
    <h6 class="section-title text-uppercase mb-3">Pesanan Saya</h6>
    <div class="nav-links">
      <a href="{{ route('profile.pesanan') }}"
        class="sidebar-link {{ request()->routeIs('profile.pesanan') ? 'sidebar-active' : '' }}">
        <i class="fa-solid fa-boxes-packing me-2"></i>
        Semua Pesanan
      </a>
      <a href="{{ route('profile.pesanan-dikirim') }}"
        class="sidebar-link {{ request()->routeIs('profile.pesanan-dikirim') ? 'sidebar-active' : '' }}">
        <i class="fa-solid fa-car-side me-2"></i>
        Dikirim
      </a>
      <a href="{{ route('profile.pesanan-selesai') }}"
        class="sidebar-link {{ request()->routeIs('profile.pesanan-selesai') ? 'sidebar-active' : '' }}">
        <i class="fa-solid fa-check-circle me-2"></i> Pesanan Selesai
      </a>
      <a href="{{ route('profile.ulasan') }}"
        class="sidebar-link {{ request()->routeIs('profile.ulasan*') || request()->routeIs('reviews.*') ? 'sidebar-active' : '' }}">
        <i class="fa-solid fa-star me-2"></i>
        Ulasan
      </a>
    </div>
  </div>

  @livewire('sidebar-notification')
</div>
