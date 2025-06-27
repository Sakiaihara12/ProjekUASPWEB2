<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Pesen.in</title>

    <!-- Fonts & Tailwind -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="bg-orange-50 text-gray-800">

    <div class="min-h-screen flex flex-col justify-center items-center px-6">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-orange-600 mb-4">🍽️ Selamat Datang di <span class="text-blue-600">Pesen.in</span></h1>
            <p class="text-lg text-gray-600 mb-8">Aplikasi pemesanan makanan cepat, mudah, dan praktis!</p>

            <div class="space-x-4">
                <a href="{{ route('login') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded shadow">
                    Register
                </a>
            </div>
        </div>
    </div>

</body>
</html>
