<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <div class="container my-5">
        <h2 class="mb-4 text-warning">📋 Daftar Menu</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 text-end">
            <a href="{{ route('admin.menus.create') }}" class="btn btn-warning text-white">
                + Tambah Menu
            </a>
        </div>

        <div class="row g-4">
            @forelse ($menus as $menu)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="gambar menu">
                        @else
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                Tidak ada gambar
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $menu->name }}</h5>
                            <p class="card-text">{{ $menu->description }}</p>
                            <p class="fw-semibold text-warning">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                            <p class="text-muted small">Stok: {{ $menu->stock }}</p>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-decoration-none text-primary small">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-sm text-danger p-0">🗑️ Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada menu.</p>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
