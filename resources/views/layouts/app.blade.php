<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS & Figtree Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>
    {{-- ✅ Navbar --}}
    @include('layouts.nav-bootstrap')

    {{-- ✅ Header --}}
    @hasSection('header')
        <header class="bg-white border-bottom shadow-sm mb-4">
            <div class="container py-3">
                <h2 class="h4 fw-bold text-primary">
                    @yield('header')
                </h2>
            </div>
        </header>
    @endif

    {{-- ✅ Main Content --}}
    <main class="container pb-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
