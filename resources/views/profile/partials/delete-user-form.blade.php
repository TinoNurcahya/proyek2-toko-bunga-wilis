<section class="mb-4">
    <header class="mb-4 ms-2">
        <h2 class="h5 fw-bold text-dark">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="small text-muted">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.') }}
        </p>
    </header>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        {{ __('Hapus Akun') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                @if (auth()->user()->google_id)
                    <!-- tampilan untuk login lewat google -->
                    <form method="POST" action="{{ route('profile.destroy') }}" id="socialDeleteForm">
                        @csrf
                        @method('delete')

                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModalLabel">
                                {{ __('Hapus Akun') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="alert alert-warning">
                                <i class="fab fa-google me-2"></i>
                                <strong>Akun Google Terdeteksi</strong>
                            </div>

                            <p class="small text-muted">
                                {{ __('Akun Anda terhubung dengan Google. Penghapusan akun tidak memerlukan verifikasi password.') }}
                            </p>

                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Semua data akan
                                dihapus permanen.
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Batal') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                {{ __('Hapus Akun Permanen') }}
                            </button>
                        </div>
                    </form>
                @else
                    <!-- tampilan untuk login normal -->
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModalLabel">
                                {{ __('Yakin ingin menghapus akun?') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <p class="small text-muted">
                                {{ __('Setelah akun dihapus, semua data akan terhapus secara permanen. Masukkan password Anda untuk konfirmasi penghapusan akun.') }}
                            </p>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                    placeholder="{{ __('Masukkan password Anda') }}" required>

                                @error('password', 'userDeletion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Batal') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                {{ __('Hapus Akun') }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</section>
