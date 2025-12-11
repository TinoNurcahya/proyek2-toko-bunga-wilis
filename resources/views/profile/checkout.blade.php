@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
  <div class="container-fluid py-4 mt-5">
    <!-- Panggil Livewire Component -->
    @livewire('checkout-page')
  </div>
@endsection
