<div>
    {{-- Judul --}}
    <strong class="fw-bold fraunces h5 d-block mb-4 m-3">Penilaian Pengguna</strong>

    {{-- Jika tidak ada review --}}
    @if ($reviews->count() == 0)
        <div class="text-center py-4">
            <i class="fas fa-comment-slash text-muted fa-3x mb-3"></i>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                Belum ada ulasan untuk produk ini.
            </p>
            <small class="text-muted" style="font-size: 0.75rem;">
                Jadilah yang pertama memberikan ulasan!
            </small>
        </div>
    @else
        {{-- Debug info (sembunyikan di production) --}}
        <div style="display: none;">
            <p>Total Reviews: {{ $reviews->total() }}</p>
            <p>Current Page: {{ $reviews->currentPage() }}</p>
        </div>
    @endif

    {{-- Daftar review --}}
    @foreach ($reviews as $review)
        <div class="mb-4 pb-3 border-bottom m-3">

            <div class="d-flex gap-3 align-items-start">

                {{-- Foto profil dengan error handling --}}
                @php
                    $user = $review->user;
                    $fotoProfil =
                        $user && $user->foto_profil
                            ? asset('storage/' . $user->foto_profil)
                            : asset('images/default/default-avatar.png');
                @endphp

                <img src="{{ $fotoProfil }}" class="rounded-circle"
                    style="width: 45px; height: 45px; object-fit: cover;"
                    alt="Foto profil {{ $user ? $user->nama : 'User' }}"
                    onerror="this.src='{{ asset('images/default/default-avatar.png') }}'">

                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-1" style="font-size: 0.9rem;">
                        {{ $user ? $user->nama : 'User Terhapus' }}
                    </h6>

                    {{-- Rating --}}
                    <div class="text-success mb-1" style="font-size: 0.8rem;">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>

                    {{-- Tanggal --}}
                    <small class="text-muted d-block mb-2" style="font-size: 0.75rem;">
                        {{ \Carbon\Carbon::parse($review->tanggal_review)->translatedFormat('d F Y') }}
                    </small>

                    {{-- Komentar --}}
                    <p class="mb-0" style="font-size: 0.9rem;">
                        {{ $review->komentar }}
                    </p>
                </div>
            </div>

        </div>
    @endforeach

    {{-- Pagination --}}
    @if ($reviews->hasPages())
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="text-muted small mb-2 mb-md-0">
                    Menampilkan {{ $reviews->firstItem() }} - {{ $reviews->lastItem() }}
                    dari {{ $reviews->total() }} ulasan
                </div>

                {{ $reviews->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    @endif
</div>
