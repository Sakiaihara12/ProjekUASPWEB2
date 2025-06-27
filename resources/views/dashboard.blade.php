<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Top Menu') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-600">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Notifikasi Berhasil --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($menus as $menu)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-orange-600">{{ $menu->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $menu->description }}</p>
                            <p class="font-semibold text-blue-600">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

                            <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="mt-3">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" class="w-full border px-2 py-1 rounded mb-2" />
                                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded">
                                    🛒 Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-white">Belum ada menu tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
