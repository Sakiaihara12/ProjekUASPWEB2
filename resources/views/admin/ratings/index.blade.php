<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Rating Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star-filled { color: #ffc107; } /* kuning */
        .star-empty { color: #ddd; }     /* abu */
    </style>
</head>
<body class="bg-light text-dark">

    @include('layouts.navbar') {{-- Navbar admin --}}

    <div class="container py-5">
        <h2 class="mb-4 text-warning">⭐ Daftar Rating Menu</h2>

        @forelse ($ratings as $rating)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <p><strong>Menu:</strong> {{ $rating->menu->name }}</p>
                    <p><strong>User:</strong> {{ $rating->user->name }} ({{ $rating->user->email }})</p>

                    <p><strong>Rating:</strong>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating->rating)
                                <span class="star-filled">★</span>
                            @else
                                <span class="star-empty">☆</span>
                            @endif
                        @endfor
                    </p>

                    @if ($rating->comment)
                        <p><strong>Komentar:</strong> {{ $rating->comment }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-secondary text-center">
                Belum ada rating yang masuk.
            </div>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
