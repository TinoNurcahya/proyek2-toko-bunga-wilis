@if (!auth()->user()->google_id)
    <section class="mb-4">
        <header class="mb-4 ms-2">
            <h2 class="h5 fw-bold text-dark">
                {{ __('Perbarui Password') }}
            </h2>
            <p class="small text-muted">
                {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.') }}
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="row mx-3">
                <!-- Form Content -->
                <div class="col-12">
                    <div class="mb-3 row align-items-center">
                        <label for="update_password_current_password"
                            class="col-sm-4 col-form-label text-nowrap fw-semibold">{{ __('Password Sekarang') }}</label>
                        <div class="col-sm-8">
                            <input id="update_password_current_password" name="current_password" type="password"
                                class="form-control" autocomplete="current-password"
                                placeholder="Masukkan password sekarang">
                            @if ($errors->updatePassword->has('current_password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->updatePassword->first('current_password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="update_password_password"
                            class="col-sm-4 col-form-label text-nowrap fw-semibold">{{ __('Password baru') }}</label>
                        <div class="col-sm-8">
                            <input id="update_password_password" name="password" type="password" class="form-control"
                                autocomplete="new-password" placeholder="Masukkan password baru" minlength="8">
                            @if ($errors->updatePassword->has('password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->updatePassword->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="update_password_password_confirmation"
                            class="col-sm-4 col-form-label text-nowrap fw-semibold">{{ __('Konfirmasi password') }}</label>
                        <div class="col-sm-8">
                            <input id="update_password_password_confirmation" name="password_confirmation"
                                type="password" class="form-control" autocomplete="new-password"
                                placeholder="Konfirmasi password" minlength="8">
                            @if ($errors->updatePassword->has('password_confirmation'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->updatePassword->first('password_confirmation') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit"
                                class="btn btn-green rounded text-white px-4 p-2">{{ __('Simpan') }}</button>
                            @if (session('status') === 'password-updated')
                                <p class="small text-muted mb-0 ms-2">
                                    {{ __('Password disimpan.') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@else
    <!-- Google users -->
    <section class="mb-4">
        <header class="mb-4 ms-2">
            <h2 class="h5 fw-bold text-dark">
                {{ __('Perbarui Password') }}
            </h2>
            <p class="small text-muted">
                {{ __('Anda login menggunakan akun Google. Fitur perubahan password tidak tersedia.') }}
            </p>
        </header>

        <div class="alert btn-green mx-3">
            <div class="d-flex align-items-center">
                <i class="fab fa-google me-3 fs-5"></i>
                <div>
                    <h6 class="mb-1">Akun Google Terdeteksi</h6>
                    <p class="mb-0 small">Untuk mengubah password, silakan gunakan fitur manajemen akun Google Anda.</p>
                </div>
            </div>
        </div>
    </section>
@endif
