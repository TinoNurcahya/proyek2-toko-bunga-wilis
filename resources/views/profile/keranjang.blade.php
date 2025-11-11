@extends('layouts.app')

@section('title', 'Keranjang Saya')

@section('content')
    <section>
        <div class="py-4 mt-5">
            <div class="container montserrat">
                <div class="row g-4">
                    <!-- Sidebar -->
                    <div class="col-md-3">
                        @include('profile.partials.sidebar')
                    </div>

                    <!-- Konten Keranjang -->
                    <div class="col-md-9">
                        <div class="card shadow-sm">
                            <div class="card-body ms-3 me-3">
                                @auth
                                    @livewire('cart-list')
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection