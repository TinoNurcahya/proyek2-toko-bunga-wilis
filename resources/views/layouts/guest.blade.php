@props(['title' => config('app.name', 'Laravel')])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="bg-dark daunbg">
    {{-- navbar --}}
    @include('layouts.navigation')


    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-1 daunbg">
        {{ $slot }}
    </div>

</body>

</html>
