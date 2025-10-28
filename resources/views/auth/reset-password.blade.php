<x-guest-layout title="Reset Password - {{ config('app.name', 'Laravel') }}">

    <!-- Kotak Reset Password -->
    <section class="flex-grow-1 d-flex align-items-center justify-content-center fraunces" style="width: 100%;">
        <div class="login-box">
            <h3 class="text-center mb-4">{{ __('Reset Password') }}</h3>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-floating mb-3">
                    <x-text-input id="email" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="off" placeholder=" " />
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

                <x-primary-button class="w-100 mb-2">
                    {{ __('Reset Password') }}
                </x-primary-button>
        </div>
        </form>
    </section>
</x-guest-layout>
