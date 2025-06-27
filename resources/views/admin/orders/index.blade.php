<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-orange-600">
            Pesanan Masuk
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        @if ($orders->isEmpty())
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded text-center">
                Belum ada pesanan masuk.
            </div>
        @else
            @foreach ($orders as $order)
                <div class="bg-white shadow rounded-xl p-6 mb-6">
                    <div class="mb-2">
                        <span class="font-semibold text-gray-800">Pembeli:</span>
                        {{ $order->user->name }} ({{ $order->user->email }})
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold text-gray-800">Tanggal:</span>
                        {{ $order->created_at->format('d M Y H:i') }}
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold text-gray-800">Metode Bayar:</span>
                        <span class="uppercase">{{ $order->payment_type }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="font-semibold text-gray-800">Total:</span>
                        <span class="text-orange-500 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div>
                        <h3 class="font-bold mb-2 text-blue-600">Item:</h3>
                        <ul class="list-disc pl-5 text-sm text-gray-700">
                            @foreach ($order->items as $item)
                                <li>
                                    {{ $item->menu->name }} (x{{ $item->quantity }}) - 
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
