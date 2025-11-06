@auth
    @if (Auth::user()->hasVerifiedEmail())
        <!-- Notification Bell untuk SUDAH VERIFIKASI -->
        <div class="notif-hover-container position-relative me-3">
            <a class="text-white text-decoration-none position-relative" href="{{ route('profile.notifikasi.edit') }}">
                <i class="fas fa-bell"></i>
                @if ($unreadCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle rounded-pill badge bg-danger">
                        <span>{{ $unreadCount }}</span>
                    </span>
                @endif
            </a>
            <div class="notif-popup position-absolute border border-success">
                <div class="p-3">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-bell text-success fa-lg me-2"></i>
                        <h6 class="mb-0 fw-bold">Notifikasi</h6>
                    </div>

                    @if ($recentNotifications->count() > 0)
                        <div class="notifications-list" style="max-height: 200px; overflow-y: auto;">
                            @foreach ($recentNotifications as $notification)
                                <div class="notification-item border-bottom pb-2 mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <p
                                                class="mb-1 {{ $notification->status == 'belum_dibaca' ? 'fw-semibold text-dark' : 'text-muted' }}">
                                                {{ Str::limit($notification->judul, 25) }}
                                            </p>
                                            <small class="text-muted">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        @if ($notification->status == 'belum_dibaca')
                                            <span class="badge bg-danger ms-2">Baru</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-bell-slash text-muted fa-2x mb-2"></i>
                            <p class="mb-0 small text-muted">Tidak ada notifikasi</p>
                        </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('profile.notifikasi.edit') }}" class="btn btn-success btn-sm w-100">
                            <i class="fas fa-list me-1" style="color: white"></i>
                            Tampilkan Semua
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Notification untuk BELUM VERIFIKASI -->
        <div class="notif-hover-container position-relative me-3">
            <a class="text-white position-relative text-decoration-none" href="#" style="pointer-events: none;">
                <i class="fas fa-bell"></i>
            </a>
            <div class="notif-popup position-absolute">
                <div class="p-3 text-center">
                    <i class="fas fa-bell fa-2x text-warning mb-2"></i>
                    <p class="mb-2 small">Email belum terverifikasi</p>
                    <form method="POST" action="{{ route('verification.send') }}" class="mb-2">
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
                    <a href="{{ route('register') }}" class="btn btn-outline-success w-100">Daftar</a>
                </div>
            </div>
        </div>
    </div>
@endauth
