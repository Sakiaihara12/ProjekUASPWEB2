<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <div class="container my-5">
        <h2 class="mb-4 text-warning">📦 Pesanan Masuk</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-warning text-center">
                Belum ada pesanan masuk.
            </div>
        @else
            @foreach ($orders as $order)
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <p class="mb-1">
                            <strong>Pembeli:</strong> {{ $order->user->name }} ({{ $order->user->email }})
                        </p>
                        <p class="mb-1">
                            <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}
                        </p>
                        <p class="mb-1">
                            <strong>Metode Bayar:</strong> <span class="text-uppercase">{{ $order->payment_type }}</span>
                        </p>
                        <p class="mb-3">
                            <strong>Total:</strong> <span class="text-warning fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </p>

                        <div>
                            <h5 class="text-primary">Item:</h5>
                            <ul class="ms-3 small">
                                @foreach ($order->items as $item)
                                    <li>
                                        {{ $item->menu->name }} (x{{ $item->quantity }}) -
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
