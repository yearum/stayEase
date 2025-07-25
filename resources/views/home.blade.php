<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>StayEase - Penginapan Mudah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f5f7fa, #c3cfe2);
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            position: relative;
            padding: 120px 0;
            background: url('{{ asset('images/R.jpg') }}') center center / cover no-repeat;
            color: white;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.7);
        }
        .hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        .hero .container {
            position: relative;
            z-index: 2;
        }
        .card-hover:hover {
            transform: scale(1.02);
            transition: 0.3s ease-in-out;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">StayEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    {{-- Hero Section --}}
    <div class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di StayEase</h1>
            <p class="lead">Temukan dan pesan penginapan favoritmu dengan mudah.</p>
            <a href="{{ route('hotels.index') }}" class="btn btn-lg btn-primary mt-3">Cari Hotel</a>
        </div>
    </div>

    {{-- Fitur --}}
    <div class="container py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card card-hover p-4 border-0 shadow-sm">
                    <h4>Hotel Berkualitas</h4>
                    <p>Pilihan hotel terpercaya dan ternyaman di seluruh Indonesia.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-hover p-4 border-0 shadow-sm">
                    <h4>Booking Mudah</h4>
                    <p>Pilih kamar, tanggal, bayar — selesai hanya dalam beberapa klik!</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-hover p-4 border-0 shadow-sm">
                    <h4>Review Terpercaya</h4>
                    <p>Lihat ulasan dari pengunjung lain sebelum kamu memesan.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-dark text-white py-4 text-center">
        <p class="mb-0">StayEase &copy; {{ date('Y') }} - All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
