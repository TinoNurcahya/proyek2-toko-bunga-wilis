<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts (opsional) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite assets (Bootstrap & JS kamu dari npm) -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex flex-column">
        {{-- Navbar --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @hasSection('header')
            <header class="bg-white shadow-sm border-bottom">
                <div class="container py-3">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Page Content --}}
        <main class="flex-grow-1 py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        {{-- Footer --}}
        <footer class="bg-white border-top text-center py-3 small text-muted">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </footer>
    </div>
</body>

</html>
