<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff7ed;
        }
    </style>
</head>
<body class="py-5">

    <div class="container">
        <h2 class="text-center text-warning fw-bold mb-4">🛒 Keranjang Saya</h2>

        @if (session('success'))
            <div class="alert alert-success small">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger small">{{ session('error') }}</div>
        @endif

        @if ($carts->count())
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-warning">
                            <tr>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($carts as $cart)
                                @php $total += $cart->menu->price * $cart->quantity; @endphp
                                <tr>
                                    <td>{{ $cart->menu->name }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>Rp {{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-light">
                                <td colspan="2" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-body border-top">
                    <form action="{{ route('cart.checkout') }}" method="POST" onsubmit="return confirm('Yakin ingin memesan dan memilih metode pembayaran ini?')">
                        @csrf
                        <div class="mb-3">
                            <label for="payment_type" class="form-label">Pilih Metode Pembayaran:</label>
                            <select name="payment_type" id="payment_type" class="form-select" required>
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="qris">QRIS</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary fw-semibold">
                                ✅ Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                Keranjang kamu masih kosong 🛒
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
