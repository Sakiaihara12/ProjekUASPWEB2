<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-orange-600">
            Tambah Menu Baru
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8 max-w-xl">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Menu</label>
                <input type="text" name="name" class="w-full border px-4 py-2 rounded mt-1" required value="{{ old('name') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border px-4 py-2 rounded mt-1">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                <input type="number" name="price" class="w-full border px-4 py-2 rounded mt-1" step="100" required value="{{ old('price') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stock" class="w-full border px-4 py-2 rounded mt-1" required value="{{ old('stock') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar Menu</label>
                <input type="file" name="image" accept="image/*" class="mt-1">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.menus.index') }}" class="text-gray-600 hover:underline mr-4">Kembali</a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
