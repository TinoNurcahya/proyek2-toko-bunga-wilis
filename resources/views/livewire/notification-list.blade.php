<div>
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h5 fw-bold text-dark mb-1">Notifikasi Saya</h2>
            <p class="small text-muted mb-0">Kelola notifikasi Anda.</p>
        </div>

        @if ($notifications->where('status', 'belum_dibaca')->count() > 0)
            <button wire:click="markAllAsRead" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-check-double me-1"></i>
                Tandai Semua Dibaca
            </button>
        @endif
    </div>

    <!-- Notifications List -->
    @if ($notifications->count() > 0)
        <div class="list-group">
            @foreach ($notifications as $item)
                <div
                    class="list-group-item list-group-item-action mb-1 
                    {{ $item->status == 'belum_dibaca' ? 'bg-light border-start border-success border-1' : '' }}">

                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1 me-3" style="min-width: 0;">
                            <p class="mb-1 {{ $item->status == 'belum_dibaca' ? 'fw-bold text-dark' : 'text-muted' }}">
                                {{ $item->judul }}
                            </p>
                            <p
                                class="mb-1 {{ $item->status == 'belum_dibaca' ? 'fw-normal text-dark' : 'text-muted' }}">
                                {{ $item->pesan }}
                            </p>
                            <small class="text-muted">
                                <i class="far fa-clock me-1"></i>
                                {{ $item->created_at->diffForHumans() }}
                            </small>
                        </div>

                        <div class="d-flex gap-2 flex-shrink-0">
                            @if ($item->status == 'belum_dibaca')
                                <button wire:click="markAsRead({{ $item->id_notifikasi }})"
                                    class="btn btn-sm btn-outline-success" title="Tandai sudah dibaca">
                                    <i class="fas fa-check"></i>
                                </button>
                            @endif

                            <button wire:click="delete({{ $item->id_notifikasi }})" wire:confirm="Hapus notifikasi ini?"
                                class="btn btn-sm btn-outline-danger" title="Hapus notifikasi">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="text-muted small mb-2 mb-md-0">
                    Menampilkan {{ $notifications->firstItem() }} - {{ $notifications->lastItem() }}
                    dari {{ $notifications->total() }} notifikasi
                </div>

                {{ $notifications->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-4">
            <img src="{{ asset('images/empty-notification.jpg') }}" class="img-fluid w-50 mb-3"
                alt="Notifikasi kosong">
            <h5 class="text-muted fw-bold mb-3">Notifikasi kosong</h5>
            <p class="text-muted small mx-auto mb-4" style="max-width: 400px;">
                Notifikasi akan muncul di sini ketika ada aktivitas baru.
            </p>
        </div>
    @endif
</div>

@script
    <script>
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            const mainHeader = document.querySelector('h2.h5.fw-bold.text-dark');
            if (mainHeader) {
                const headerPosition = mainHeader.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = headerPosition - 100;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            } else {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
    </script>
@endscript
