<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samudra Property - Penginapan Murah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
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
        @media (max-width: 768px) {
            .hero {
                padding: 80px 20px;
                text-align: center;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .hero p.lead {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Samudra Property</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#hotel">Hotel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>

                @auth
                <!-- Tampilkan tombol logout jika user sudah login -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center ms-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
                @else
                <!-- Tampilkan tombol login jika user belum login -->
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary ms-3">Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero text-center" style="margin-top: 75px;">
    <div class="container">
        <h1 class="display-4 fw-bold">Selamat Datang di Samudra Property</h1>
        <p class="lead">Temukan dan pesan penginapan favoritmu dengan harga terjangkau.</p>
        <a href="{{ route('hotels.index') }}" class="btn btn-lg btn-primary mt-3">Cari Hotel</a>
    </div>
</div>

<!-- Section: Hotel -->
<section id="hotel" class="container py-5">
    <h2 class="text-center mb-4">Hotel terjangkau</h2>
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
</section>

<!-- Section: Tentang -->
<section id="tentang" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Tentang Kami</h2>
        <p class="text-center">Samudra Property adalah platform terpercaya untuk mencari dan memesan hotel dengan mudah. Kami hadir untuk membuat perjalananmu lebih nyaman dan efisien.</p>
    </div>
</section>

<!-- Section: Kontak -->
<section id="kontak" class="container py-5">
    <h2 class="text-center mb-4">Kontak Kami</h2>
    <p class="text-center">Email: support@stayease.com | Telepon: +62 81299744583</p>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-4 text-center">
    <p class="mb-0">Samudra Property &copy; {{ date('Y') }} - All Rights Reserved</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
