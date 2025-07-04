<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <!-- Bootstrap 5 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star-filled { color: #ffc107; }
        .star-empty { color: #ddd; }
    </style>
</head>
<body class="bg-light">

@include('layouts.navbar') {{-- Tambahkan navbar jika perlu --}}

<div class="container py-5">
    <h2 class="mb-4 text-center text-warning fw-bold">🧾 Riwayat Pesanan</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <div class="alert alert-info text-center">
            Kamu belum memiliki riwayat pesanan.
        </div>
    @else
        @foreach ($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <p class="mb-1"><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p class="mb-1"><strong>Metode Bayar:</strong> {{ ucfirst($order->payment_type) }}</p>
                    <p class="mb-3"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

                    <h6 class="text-warning fw-bold">Item Pesanan:</h6>
                    <ul class="list-group list-group-flush mb-3">
                        @foreach ($order->items as $item)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        {{ $item->menu->name }} (x{{ $item->quantity }}) - 
                                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                        
                                        @php
                                            $hasRated = $item->menu->ratings()
                                                ->where('user_id', auth()->id())
                                                ->where('order_id', $order->id)
                                                ->exists();
                                        @endphp

                                        @if (!$hasRated)
                                            <form action="{{ route('ratings.store') }}" method="POST" class="row g-2 mt-2">
                                                @csrf
                                                <input type="hidden" name="menu_id" value="{{ $item->menu_id }}">
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">

                                                <div class="col-md-2">
                                                    <select name="rating" class="form-select form-select-sm" required>
                                                        <option value="">Pilih</option>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="comment" class="form-control form-control-sm" placeholder="Komentar (opsional)">
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <button type="submit" class="btn btn-sm btn-primary">Kirim Rating</button>
                                                </div>
                                            </form>
                                        @else
                                            <span class="text-success small">✅ Sudah diberi rating</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="fw-bold text-end text-primary">
                        Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </div>

                    <form action="{{ route('orders.reorder', $order->id) }}" method="POST" class="text-end mt-3">
                        @csrf
                        <button class="btn btn-warning">
                            🔁 Pesan Kembali
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
