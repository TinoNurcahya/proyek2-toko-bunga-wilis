@extends('layouts.app') {{-- gunakan layout utama --}}

@section('title', 'Dashboard')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-3">
                    <i class="fa-solid fa-lock text-danger"></i>
                    Hi, {{ auth()->user()->nama }}
                </h1>
                <p class="mb-4">Welcome to your dashboard!</p>

                <div class="d-flex gap-2">
                    <i class="fa-brands fa-laravel text-danger fs-3"></i>
                    <i class="fa-regular fa-heart text-danger fs-3"></i>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
