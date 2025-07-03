<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <!-- Bootstrap 5 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-orange text-center fw-bold">Riwayat Pesanan</h2>

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
                    <p class="text-muted small mb-2">
                        <strong>Tanggal:</strong> {{ $order->created_at->format(_
