<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-orange-600">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h1 class="text-xl font-semibold text-gray-700 mb-4">Selamat datang, kamu berhasil login sebagai admin.</h1>
            <div class="flex justify-center gap-6 mt-4">
                <a href="{{ route('admin.menus.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow">
                    ➕ Kelola Menu
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg shadow">
                    📦 Pesanan Masuk
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
