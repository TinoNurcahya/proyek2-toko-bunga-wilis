<x-guest-layout title="Lupa Password - {{ config('app.name', 'Laravel') }}">
    <section class="flex-grow-1 d-flex align-items-center justify-content-center fraunces" style="width: 100%;">
        <div class="login-box">
            <h3 class="text-center mb-3">{{ __('Lupa Password') }}</h3>
            <div class="mb-4 text-white text-center fw-light montserrat">
                {{ __('Lupa kata sandi? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset kata sandi untuk memilih kata sandi baru.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-floating mb-3">
                    <x-text-input id="email" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="off" placeholder=" " />
                    <x-input-label for="email" :value="__('Email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('login') }}" class="text-white fw-light underlined">
                        {{ __('Kembali') }}
                    </a>
                    <x-primary-button class="py-2">
                        {{ __('Kirim Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
