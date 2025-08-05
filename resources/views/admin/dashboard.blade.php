<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ✅ Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #212529;
        }
        .navbar-brand, .nav-link, .btn-logout {
            color: #fff;
        }
        .nav-link:hover, .btn-logout:hover {
            color: #0d6efd;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .section-title {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="ms-auto">
            <a href="{{ route('admin.logout') }}" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Dashboard Admin</h2>
            <p class="text-muted">Selamat datang, Admin!</p>
        </div>
    </div>

    <div class="row g-4">
    <!-- Kartu hotel -->
    @foreach ($hotels as $hotel)
        <div class="col-md-4">
            <div class="card p-3">
                <div class="section-title">Kelola Ketersediaan Kamar</div>
                <p><strong>{{ $hotel->name }}</strong></p>
                <p class="text-muted">Lihat dan atur jumlah kamar tersedia untuk hotel ini.</p>
                <a href="{{ route('admin.hotels.rooms', ['hotel' => $hotel->id]) }}" class="btn btn-primary btn-sm">Kelola Kamar</a>
            </div>
        </div>
    @endforeach
</div>

        <!-- Status Pembayaran COD -->
        <div class="col-md-4">
            <div class="card p-3">
                <div class="section-title">Atur Status Pembayaran COD</div>
                <p class="text-muted">Konfirmasi pembayaran yang menggunakan metode Cash on Delivery.</p>
                <a href="{{ route('bookings.index') }}" class="btn btn-warning btn-sm">Lihat Booking COD</a>
            </div>
        </div>

        <!-- Notifikasi Transaksi Transfer -->
        <div class="col-md-4">
            <div class="card p-3">
                <div class="section-title">Notifikasi Transaksi Transfer</div>
                <p class="text-muted">Lihat transaksi baru dari metode transfer ketika user klik Bayar Sekarang.</p>
                <a href="{{ route('bookings.index') }}" class="btn btn-success btn-sm">Lihat Transaksi</a>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
