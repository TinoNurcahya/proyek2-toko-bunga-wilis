@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
  <div class="py-4 mt-5">
    <div class="container montserrat">
      <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-md-3">
          @include('profile.partials.sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              @include('profile.partials.update-profile-information-form')
            </div>
          </div>

          <div class="card shadow-sm mb-4">
            <div class="card-body">
              @include('profile.partials.update-password-form')
            </div>
          </div>

          <div class="card shadow-sm d-md-none mb-4">
            <div class="card-body">
              <header class="mb-4 ms-2">
                <h2 class="h5 fw-bold text-dark">
                  {{ __('Keluar') }}
                </h2>
                <p class="small text-muted">
                  {{ __('Anda akan keluar dari akun ini. Apakah Anda yakin?') }}
                </p>
              </header>

              <!-- Button trigger modal -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger fw-medium">Keluar</button>
              </form>
            </div>
          </div>

          <div class="card shadow-sm">
            <div class="card-body">
              @include('profile.partials.delete-user-form')
            </div>
          </div>
        </div>
        <!-- End Main Content Area -->

      </div>
    </div>
  </div>
@endsection