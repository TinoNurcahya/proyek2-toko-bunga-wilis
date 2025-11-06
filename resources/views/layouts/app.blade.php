<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <!-- Vite assets-->
    @vite(['resources/js/app.js'])
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
        <x-footer />
    </div>
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed" style="z-index: 2000; top: 100px; right: 400px;">
        <div id="toastContainer" class="toast-container"></div>
    </div>

    @stack('scripts')
    <script>
        window.addEventListener('show-toast', event => {
            const {
                type,
                message
            } = event.detail;
            const bgClass = {
                success: 'bg-success text-white',
                info: 'bg-info text-white',
                warning: 'bg-warning text-dark',
                error: 'bg-danger text-white'
            } [type] || 'bg-secondary text-white';
            const iconClass = {
                success: 'fas fa-check-circle',
                info: 'fas fa-info-circle',
                warning: 'fas fa-exclamation-triangle',
                error: 'fas fa-exclamation-circle'
            } [type] || 'fas fa-bell';
            const toast = document.createElement('div');
            toast.className = `toast align-items-center border-0 ${bgClass}`;
            toast.role = 'alert';
            toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body d-flex align-items-start">
                    <i class="${iconClass} me-3 mt-1 flex-shrink-0"></i>
                    <span class="fw-semibold flex-grow-1" style="word-break: break-word;">${message}</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-3 m-auto flex-shrink-0" data-bs-dismiss="toast"></button>
            </div>
        `;
            document.getElementById('toastContainer').appendChild(toast);

            const bsToast = new bootstrap.Toast(toast, {
                delay: 2500
            });
            bsToast.show();

            // Hapus elemen toast setelah animasi selesai
            toast.addEventListener('hidden.bs.toast', () => toast.remove());
        });
    </script>
</body>

</html>
