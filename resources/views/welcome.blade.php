<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Pesen.in</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(to bottom right, #fff7ed, #fef3c7);
            min-height: 100vh;
        }

        .fade-in {
            animation: fade-in 0.6s ease-out;
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
    </style>
</head>

<body class="d-flex align-items-center justify-content-center px-3 py-5">

    <div class="bg-white border border-warning-subtle shadow-lg rounded-4 p-5 text-center w-100 fade-in" style="max-width: 500px;">
        <div class="fs-1 mb-3">🍽️</div>

        <h1 class="fw-bold mb-2">
            <span class="text-warning">Selamat Datang di</span>
            <span class="text-primary">Pesen.in</span>
        </h1>

        <p class="text-muted mb-4">
            Aplikasi pemesanan makanan cepat, mudah, dan praktis!
        </p>

        <!-- Tombol Login & Register -->
        <div class="d-grid gap-2 d-sm-flex justify-content-center mb-3">
            <a href="{{ route('login') }}" class="btn btn-warning text-white px-4">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary text-white px-4">
                Register
            </a>
        </div>

        <!-- Tombol Login Admin -->
        <div>
            <a href="{{ route('admin.login') }}" class="btn btn-dark btn-sm px-4">
                👨‍💼 Login sebagai Admin
            </a>
        </div>
    </div>

</body>

</html>
