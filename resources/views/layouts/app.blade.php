<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1d3a1a">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <!-- Vite assets-->
    @vite(['resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex flex-column">
        {{-- Navbar --}}
        @include('layouts.navigation')

        {{-- Page Content --}}
        <main class="flex-grow-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        <x-footer />
    </div>
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed" style="z-index: 2000; top: 100px; right: 400px;">
        <div id="toastContainer" class="toast-container"></div>
    </div>

    @stack('scripts')
</body>

</html>
