@extends('layouts.app')

@section('title', 'Alamat Saya')

@section('content')
    <div class="py-4 mt-5">
        <div class="container montserrat">
            <div class="row g-4">

                <!-- Sidebar -->
                <div class="col-md-3">
                    @include('profile.partials.sidebar')
                </div>

                <!-- Konten Alamat -->
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-body ms-3 me-3">
                            <!-- Header -->
                            <div class="mb-4">
                                <h2 class="h5 fw-bold text-dark mb-1">{{ __('Alamat Saya') }}</h2>
                                <p class="small text-muted mb-0">{{ __('Kelola informasi alamat anda.') }}</p>
                            </div>

                            <!-- Tampilan Alamat Saat Ini -->
                            <div class="mb-4 p-3 border rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0">{{ $user->nama }} | {{ $user->no_hp }}</h6>
                                </div>
                                <p class="mb-0 text-muted overflow-hidden">
                                    {{ $user->alamat ?: 'Belum ada alamat yang disimpan' }}
                                </p>
                            </div>

                            <!-- Form Edit Alamat -->
                            <form method="post" action="{{ route('profile.alamat.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-3">
                                    <label for="alamat" class="form-label fw-semibold">{{ __('Alamat Lengkap') }}</label>
                                    <textarea id="alamat" name="alamat" class="form-control" rows="4" required
                                        placeholder="Alamat, RT/RW, kelurahan, kecamatan, kota, dan kode pos.">{{ old('alamat', $user->alamat) }}</textarea>
                                    @if ($errors->get('alamat'))
                                        <div class="text-danger small mt-1">{{ $errors->first('alamat') }}</div>
                                    @endif
                                    <div class="form-text">
                                        Masukkan alamat lengkap termasuk jalan, RT/RW, kelurahan, kecamatan, kota, dan kode
                                        pos.
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <button type="submit"
                                        class="btn btn-green rounded text-white px-4 p-2">{{ __('Simpan Alamat') }}</button>

                                    @if (session('status') === 'address-updated')
                                        <p class="alert alert-success" role="alert">{{ __('Alamat disimpan.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
