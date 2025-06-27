<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-orange-600">
            Daftar Menu
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.menus.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                + Tambah Menu
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($menus as $menu)
                <div class="bg-white rounded-xl shadow p-4">
                    @if ($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" class="rounded-md w-full h-48 object-cover mb-3">
                    @else
                        <div class="bg-gray-100 text-gray-500 text-center py-16 rounded mb-3">
                            Tidak ada gambar
                        </div>
                    @endif

                    <h2 class="text-xl font-bold text-blue-600">{{ $menu->name }}</h2>
                    <p class="text-gray-600">{{ $menu->description }}</p>
                    <p class="mt-2 font-semibold text-orange-500">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500">Stok: {{ $menu->stock }}</p>

                    <div class="flex justify-between mt-4">
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-blue-500 hover:underline text-sm">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-sm">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Belum ada menu.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
