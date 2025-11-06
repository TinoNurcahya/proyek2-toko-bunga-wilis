<x-guest-layout title="Verifikasi Email - {{ config('app.name', 'Laravel') }}">
    <section class="flex-grow-1 d-flex align-items-center justify-content-center fraunces" style="width: 100%;">
        <div class="login-box">
            <h3 class="text-center mb-3">{{ __('Verifikasi Email') }}</h3>
            <div class="mb-4 text-white text-center fw-light montserrat">
                {{ __('Terima kasih telah mendaftar! Verifikasi email Anda dengan mengklik tautan yang kami kirim. Tidak menerima email? Kami akan kirim ulang.') }}
            </div>

            <!-- Session Status -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 alert alert-success">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('login') }}" class="text-white fw-light underlined">
                    {{ __('Kembali') }}
                </a>
                
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="btn btn-green py-2">
                        {{ __('Kirim Email') }}
                    </x-primary-button>
                </form>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="text-center mt-3">
                @csrf
                <button type="submit" class="text-white fw-light lupapswd-link border-0 bg-transparent">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </section>
</x-guest-layout>