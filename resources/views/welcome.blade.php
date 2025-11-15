@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero section --}}
    <x-hero-section />

    {{-- Tanaman indoor/outdoor --}}
    <x-category-section />

    {{-- Ukuran --}}
    <x-size-section />

    {{-- Terbaru --}}
    <x-latest-section :produkItem="$produkTerbaru" />

    {{-- Populer --}}
    <x-popular-section :produkTerlaris="$produkTerlaris" />

    {{-- Tentang Kami --}}
    <x-about-section />

    {{-- kenapa memilih kami --}}
    <x-choose-us-section />
    
    {{-- kontak --}}
    <x-contact-section />
@endsection
