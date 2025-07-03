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

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-orange-50 to-yellow-100 text-gray-800 min-h-screen flex items-center justify-center px-6 py-12">

    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-xl p-10 text-center max-w-xl w-full animate-fade-in border border-orange-100">
        <div class="text-6xl mb-4">🍽️</div>

        <h1 class="text-4xl font-extrabold mb-2">
            <span class="text-orange-600">Selamat Datang di</span>
            <span class="text-blue-600">Pesen.in</span>
        </h1>

        <p class="text-lg text-gray-600 mb-8">
            Aplikasi pemesanan makanan cepat, mudah, dan praktis!
        </p>

        <!-- Tombol Login & Register -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-4">
            <a href="{{ route('login') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg shadow transition duration-200">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow transition duration-200">
                Register
            </a>
        </div>

        <!-- Tombol Login Admin -->
        <div class="mt-2">
            <a href="{{ route('admin.login') }}"
               class="inline-block bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg shadow transition duration-200 text-sm">
                👨‍💼 Login sebagai Admin
            </a>
        </div>
    </div>

</body>

</html>
