<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Rating Menu
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-100">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @forelse ($ratings as $rating)
                <div class="bg-white p-4 rounded shadow mb-4">
                    <p><strong>Menu:</strong> {{ $rating->menu->name }}</p>
                    <p><strong>User:</strong> {{ $rating->user->name }} ({{ $rating->user->email }})</p>

                    <p><strong>Rating:</strong>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating->rating)
                                <span class="text-yellow-400">★</span>
                            @else
                                <span class="text-gray-300">☆</span>
                            @endif
                        @endfor
                    </p>

                    @if ($rating->comment)
                        <p><strong>Komentar:</strong> {{ $rating->comment }}</p>
                    @endif
                </div>
            @empty
                <div class="bg-white p-4 rounded shadow text-center text-gray-600">
                    Belum ada rating yang masuk.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
