<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu - {{ $menu->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <div class="container mt-5">
        <h2 class="mb-4 text-warning">✏️ Edit Menu: <strong>{{ $menu->name }}</strong></h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border rounded shadow-sm p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $menu->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description', $menu->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" required value="{{ old('price', $menu->price) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" required value="{{ old('stock', $menu->stock) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Menu</label><br>
                @if ($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid mb-2 rounded" style="max-height: 200px;">
                @endif
                <input type="file" name="image" accept="image/*" class="form-control mt-2">
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-warning text-white">Update</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
