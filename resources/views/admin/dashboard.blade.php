<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-orange-600">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 to-yellow-100 px-6 py-12 flex items-center justify-center">
        <div class="relative bg-white bg-opacity-90 backdrop-blur-md shadow-2xl rounded-3xl px-10 py-12 max-w-2xl w-full animate-fade-in border border-orange-100">
            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center shadow-lg">
                🍽️
            </div>
            <h1 class="text-3xl font-extrabold text-orange-600 text-center mb-4 mt-4">
                Selamat Datang di Dashboard Admin
            </h1>
            <p class="text-xl text-gray-700 text-center font-semibold">
                {{ Auth::user()->name }}
            </p>
            <p class="text-center text-gray-500 italic mt-2">
                Semoga harimu menyenangkan ☀️
            </p>

            <div class="mt-6 text-center text-sm text-gray-400">
                Kamu dapat mengelola menu dan pesanan dari menu di atas ⬆️
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</x-app-layout>
