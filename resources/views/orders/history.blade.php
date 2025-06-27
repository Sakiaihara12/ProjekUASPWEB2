<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Riwayat Pesanan
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($orders->isEmpty())
                <div class="bg-white p-6 rounded shadow text-center text-gray-600">
                    Kamu belum memiliki riwayat pesanan.
                </div>
            @else
                @foreach ($orders as $order)
                    <div class="bg-white shadow rounded-lg mb-6 p-6">
                        <div class="mb-2 text-sm text-gray-600">
                            <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }} <br>
                            <strong>Metode Bayar:</strong> {{ ucfirst($order->payment_type) }} <br>
                            <strong>Status:</strong> {{ ucfirst($order->status) }}
                        </div>

                        <h3 class="font-semibold text-orange-600 mb-2">Item Pesanan:</h3>
                        <ul class="list-disc list-inside text-sm text-gray-700">
                            @foreach ($order->items as $item)
                                <li class="mb-2">
                                    {{ $item->menu->name }} (x{{ $item->quantity }}) -
                                    Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}

                                    {{-- ✅ FORM RATING --}}
                                    @php
                                        $hasRated = $item->menu->ratings()
                                            ->where('user_id', auth()->id())
                                            ->where('order_id', $order->id)
                                            ->exists();
                                    @endphp

                                    @if (!$hasRated)
                                        <form action="{{ route('ratings.store') }}" method="POST" class="flex items-center gap-2 mt-2">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $item->menu_id }}">
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                                            <label for="rating" class="text-sm">Rating:</label>
                                            <select name="rating" required class="w-24 px-2 py-1 border rounded text-sm">
                                                <option value="">Pilih</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                                                @endfor
                                            </select>

                                            <input type="text" name="comment" placeholder="Komentar (opsional)"
                                                class="flex-1 px-2 py-1 border rounded text-sm">

                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded">
                                                Kirim
                                            </button>
                                        </form>
                                    @else
                                        <span class="ml-2 text-green-600 text-sm">✅ Sudah diberi rating</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-3 font-semibold text-blue-700">
                            Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </div>

                        {{-- ✅ Tombol Pesan Kembali --}}
                        <form action="{{ route('orders.reorder', $order->id) }}" method="POST" class="mt-4 text-right">
                            @csrf
                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
                                🔁 Pesan Kembali
                            </button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
