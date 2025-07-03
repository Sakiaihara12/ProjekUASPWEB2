<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Top Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center text-orange-600 fw-bold mb-4" style="color: #d35400;">Top Menu</h2>

    {{-- ✅ Notifikasi Berhasil --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @forelse ($menus as $menu)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $menu->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px; color: #999;">
                            Tidak ada gambar
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-orange-600" style="color: #e67e22;">{{ $menu->name }}</h5>
                        <p class="card-text text-muted small">{{ $menu->description }}</p>
                        <p class="fw-bold text-primary">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

                        <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" />
                            <button type="submit" class="btn btn-warning w-100 text-white">
                                🛒 Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">Belum ada menu tersedia.</p>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
