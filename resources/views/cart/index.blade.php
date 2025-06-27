<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Keranjang Saya
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($carts->count())
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-orange-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium">Menu</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Jumlah</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Harga</th>
                                <th class="px-6 py-3 text-right text-sm font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php $total = 0; @endphp
                            @foreach ($carts as $cart)
                                @php $total += $cart->menu->price * $cart->quantity; @endphp
                                <tr>
                                    <td class="px-6 py-4">
                                        {{ $cart->menu->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $cart->quantity }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-100">
                                <td class="px-6 py-3 font-semibold text-right" colspan="2">Total:</td>
                                <td class="px-6 py-3 font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="p-6 border-t">
                        <form action="{{ route('cart.checkout') }}" method="POST" onsubmit="return confirm('Yakin ingin memesan dan memilih metode pembayaran ini?')">
                            @csrf
                            <div class="mb-4">
                                <label for="payment_type" class="block mb-2 text-sm font-medium text-gray-700">
                                    Pilih Metode Pembayaran:
                                </label>
                                <select name="payment_type" id="payment_type" required
                                    class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500">
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <option value="qris">QRIS</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    ✅ Pesan Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="bg-white p-6 rounded shadow text-center text-gray-600">
                    Keranjang kamu masih kosong 🛒
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
