{{-- Form Tambah Review (belum di implementasi menunggu payment midtrans) --}}
@auth
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Beri Penilaian</h5>
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                        {{-- Rating Stars --}}
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="rating-stars">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating"
                                        value="{{ $i }}" required>
                                    <label for="star{{ $i }}">★</label>
                                @endfor
                            </div>
                        </div>

                        {{-- Komentar --}}
                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="3"
                                placeholder="Bagaimana pengalaman Anda dengan produk ini?" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info mt-4">
        <i class="fas fa-info-circle me-2"></i>
        <a href="{{ route('login') }}" class="alert-link">Login</a> untuk memberikan penilaian.
    </div>
@endauth
