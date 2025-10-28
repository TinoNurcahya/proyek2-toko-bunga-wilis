<x-guest-layout title="Register - {{ config('app.name') }}">
    <!-- Kotak Login -->
    <section class="flex-grow-1 d-flex align-items-center justify-content-center fraunces mt-5" style="width: 100%;">
        <div class="login-box">
            <h3 class="text-center mb-4">{{ __('Daftar') }}</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-floating mb-3">
                    <x-text-input id="name" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="off" placeholder=" " />
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="form-floating mb-3">
                    <x-text-input id="email" type="email" name="email" :value="old('email')"
                        required autocomplete="off" placeholder=" " />
                    <x-input-label for="email" :value="__('Email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <div class="form-floating flex-grow-1 position-relative">
                        <x-text-input id="password" type="password" name="password" required
                            autocomplete="new-password" placeholder=" " />
                        <x-input-label for="password" :value="__('Password')" />

                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword"
                            style="cursor:pointer; z-index: 5;">
                            <i class="fa-regular fa-eye-slash"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="input-group mb-3">
                    <div class="form-floating flex-grow-1 position-relative">
                        <x-text-input id="password_confirmation" type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder=" " />
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                            id="togglePasswordConfirmation" style="cursor:pointer; z-index: 5;">
                            <i class="fa-regular fa-eye-slash"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- I Agree Checkbox -->
                <div class="form-check mb-3">
                    <input class="form-check-input custom-checkbox" type="checkbox" value="" id="agree" required>
                    <label class="form-check-label fw-light" for="agree">
                        {{ __('I agree to the Terms and Conditions') }}
                    </label>
                    <x-input-error :messages="$errors->get('agree')" class="mt-1" />
                </div>

                <!-- Register Button -->
                <x-primary-button class="w-100 mb-2">
                    {{ __('Register') }}
                </x-primary-button>

                <!-- Link Login -->
                <p class="mb-3 text-white fw-light">
                    {{ __('Sudah Punya Akun?') }}
                    <a href="{{ route('login') }}" class="fw-light text-decoration-none daftar-login-link">
                        {{ __('Masuk') }}
                    </a>
                </p>

                <!-- Separator -->
                <div class="separator fw-light"><span>{{ __('Atau') }}</span></div>

                <!-- Login Sosial -->
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('google.redirect') }}"
                        class="btn btn-light btn-lg d-flex align-items-center justify-content-center gap-2"
                        style="width: 50px; height: 50px; border-radius: 50%;">
                        <i class="fa-brands fa-google" style="font-size: 1.5rem;"></i>
                    </a>
                </div>
            </form>
        </div>

</x-guest-layout>
