<section class="mb-4">
    <header class="mb-3 ms-2">
        <h2 class="h5 fw-bold text-dark">
            {{ __('Profil Saya') }}
        </h2>
        <p class="small text-muted">
            {{ __('Kelola informasi profil anda.') }}
        </p>
    </header>

    <!-- Form untuk re-send verification -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="container form-container-profile">
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <!-- hidden input hapus foto-->
            <input type="hidden" name="hapus_foto" id="hapus_foto" value="0">

            <!-- foto profile atas (mobile) -->
            <div class="mobile-profile-section">
                <div class="text-center px-5">
                    <!-- Foto Saat Ini -->
                    @if ($user->foto_profil)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil"
                                class="profile-picture rounded-circle mobile-profile-picture">

                            <!-- Tombol Hapus Foto Mobile -->
                            <div class="mt-2">
                                <button type="button" class="btn btn-outline-danger btn-sm mt-3" id="btn-hapus-mobile">
                                    <i class="fas fa-trash"></i> Hapus Foto
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="mb-3">
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Foto Profil Default"
                                class="profile-picture rounded-circle mobile-profile-picture">
                        </div>
                    @endif

                    <!-- Input File Mobile -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="btn-pilih-mobile">
                            <i class="fas fa-image"></i> Pilih Gambar
                        </button>

                        <input id="foto_profil_mobile" name="foto_profil" type="file" class="form-control d-none"
                            accept="image/jpeg,image/png,image/jpg">

                        <div id="file-name-mobile" class="form-text-profile mt-1 text-muted">
                            Belum ada file dipilih
                        </div>

                        @if ($errors->get('foto_profil'))
                            <div class="text-danger small mt-1">{{ $errors->first('foto_profil') }}</div>
                        @endif
                        <div class="form-text-profile text-muted">
                            Format: JPEG, JPG, PNG. Maksimal 2MB.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Form Kiri -->
                <div class="col-md-8">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-3 col-form-label fw-semibold">{{ __('Nama') }}</label>
                        <div class="col-sm-9">
                            <input id="nama" name="nama" type="text" class="form-control"
                                value="{{ old('nama', $user->nama) }}" required autofocus autocomplete="name"
                                minlength="8" maxlength="50" placeholder="Masukkan nama">
                            @if ($errors->get('nama'))
                                <div class="text-danger small mt-1">{{ $errors->first('nama') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-3 col-form-label fw-semibold">{{ __('Email') }}</label>
                        <div class="col-sm-9">
                            <input id="email" name="email" type="email" class="form-control"
                                value="{{ old('email', $user->email) }}" placeholder="Masukkan email" maxlength="100"
                                autocomplete="username"
                                @if ($user->google_id) disabled @else required @endif>

                            @if ($user->google_id)
                                <div class="form-text-profile text-success mt-1">
                                    <i class="fab fa-google me-1"></i>
                                    Email terhubung dengan akun Google dan tidak dapat diubah
                                </div>
                            @endif

                            @if ($errors->get('email'))
                                <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
                            @endif

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="small text-dark">
                                        {{ __('Email anda belum terverifikasi.') }}
                                        <button type="submit" form="send-verification"
                                            class="btn btn-link p-0 m-0 align-baseline">
                                            {{ __('Klik disini untuk mengirim ulang email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="small text-success mt-1">
                                            {{ __('Link verifikasi telah dikirim ke alamat email Anda.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="no_hp" class="col-sm-3 col-form-label fw-semibold">{{ __('No hp') }}</label>
                        <div class="col-sm-9">
                            <input id="no_hp" name="no_hp" type="number" class="form-control"
                                value="{{ old('no_hp', $user->no_hp) }}" required autocomplete="no_hp"
                                placeholder="Masukkan nomor hp" minlength="8" maxlength="15">
                            @if ($errors->get('no_hp'))
                                <div class="text-danger small mt-1">{{ $errors->first('no_hp') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jenis_kelamin"
                            class="col-sm-3 col-form-label fw-semibold">{{ __('Jenis Kelamin') }}</label>
                        <div class="col-sm-9">
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                <option value="" class="form-text-profile">Pilih Jenis Kelamin</option>
                                <option value="L" class="form-text-profile"
                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P" class="form-text-profile"
                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @if ($errors->get('jenis_kelamin'))
                                <div class="text-danger small mt-1">{{ $errors->first('jenis_kelamin') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit"
                                class="btn btn-green rounded text-white px-4 p-2">{{ __('Simpan') }}</button>

                            @if (session('status') === 'profile-updated')
                                <div class="alert alert-success mt-3 mb-0" role="alert">
                                    {{ __('Profil disimpan.') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Foto Profil desktop (kanan) -->
                <div class="col-md-4 desktop-profile-section">
                    <div class="text-center px-5 border-start">
                        <!-- Preview Foto  -->
                        @if ($user->foto_profil)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil"
                                    class="profile-picture rounded-circle">

                                <!-- Hapus foto desktop -->
                                <div class="mt-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm mt-3"
                                        id="btn-hapus-desktop">
                                        <i class="fas fa-trash"></i> Hapus Foto
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="mb-3">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Foto Profil Default"
                                    class="profile-picture rounded-circle">
                            </div>
                        @endif

                        <!-- Input di desktop -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-pilih-desktop">
                                <i class="fas fa-image"></i> Pilih Gambar
                            </button>

                            <input id="foto_profil_desktop" name="foto_profil" type="file"
                                class="form-control d-none" accept="image/jpeg,image/png,image/jpg">

                            <div id="file-name-desktop" class="form-text-profile mt-1 text-muted">
                                Belum ada file dipilih
                            </div>

                            @if ($errors->get('foto_profil'))
                                <div class="text-danger small mt-1">{{ $errors->first('foto_profil') }}</div>
                            @endif
                            <div class="form-text-profile text-muted">
                                Format: JPEG, JPG, PNG. Maksimal 2MB.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
