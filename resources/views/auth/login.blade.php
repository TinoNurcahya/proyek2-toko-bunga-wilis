<x-guest-layout title="Login - {{ config('app.name', 'Laravel') }}">
    <!-- Status Sesi -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Kotak Login -->
    <section class="flex-grow-1 d-flex align-items-center justify-content-center section-white fraunces" style="width: 100%;">
        <div class="login-box">
            <h3 class="text-center mb-4">{{ __('Masuk') }}</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-floating mb-3">
                    <x-text-input id="email" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="off" placeholder=" " />
                    <x-input-label for="email" :value="__('Email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Passwowd -->
                <div class="input-group mb-3">
                    <div class="form-floating flex-grow-1 position-relative">
                        <x-text-input id="password" type="password" name="password" required
                            autocomplete="off" placeholder=" " />
                        <x-input-label for="password" :value="__('Password')" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword"
                            style="cursor:pointer; z-index: 5;">
                            <i class="fa-regular fa-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <!-- Ingat Saya & Lupa Password -->
                <div class="d-flex justify-content-between align-items-center text-white small mb-3">
                    <div class="form-check">
                        <label for="remember_me" class="d-flex align-items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="form-check-input me-2 custom-checkbox">
                            <span>{{ __('Ingat saya') }}</span>
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-white underlined">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <!-- Tombol Login -->
                <x-primary-button class="w-100 mb-2">
                    {{ __('Login') }}
                </x-primary-button>

                <!-- Link Daftar -->
                <p class="mb-3 text-white fw-light">
                    {{ __('Belum punya akun?') }}
                    <a href="{{ route('register') }}" class="fw-medium text-decoration-none daftar-login-link">
                        {{ __('Daftar') }}
                    </a>
                </p>

                <!-- Separator -->
                <div class="separator fw-light"><span>{{ __('Atau') }}</span></div>

                <!-- Login Sosial -->
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('google.redirect') }}"
                        class="btn btn-light btn-lg d-flex align-items-center justify-content-center gap-2"
                        style="width: 50px; height: 50px; border-radius: 50%;">
                        <i class="fa-brands fa-google" style="font-size: 1.5rem; "></i>
                    </a>
                </div>
            </form>
        </div>
    </section>

</x-guest-layout>
