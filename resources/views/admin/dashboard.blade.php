<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #fff7ed, #fff9db);
            min-height: 100vh;
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .admin-icon {
            width: 64px;
            height: 64px;
            background-color: #fd7e14;
            color: white;
            font-size: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin: 0 auto;
            margin-top: -32px;
        }
    </style>
</head>
<body>

    @include('layouts.navbar') {{-- Navbar admin --}}

    <div class="container d-flex justify-content-center align-items-center py-5">
        <div class="card border-warning shadow-lg px-4 py-5 animate-fade-in text-center" style="max-width: 600px; width: 100%; backdrop-filter: blur(6px);">
            <div class="admin-icon">🍽️</div>
            <h1 class="mt-4 text-warning fw-bold">Selamat Datang di Dashboard Admin</h1>
            <p class="text-secondary fs-5 mt-2 fw-semibold">{{ Auth::user()->name }}</p>
            <p class="text-muted fst-italic">Semoga harimu menyenangkan ☀️</p>

            <div class="mt-4 text-secondary small">
                Kamu dapat mengelola menu dan pesanan dari menu navigasi di atas ⬆️
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
