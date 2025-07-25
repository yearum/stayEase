<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'StayEase')</title> {{-- Bisa diganti dinamis judulnya --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tambahan CSS opsional --}}
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">StayEase</a>

            {{-- Tambahkan menu lainnya di sini jika mau --}}
            <div>
                <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
                <a class="btn btn-outline-light" href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </nav>

    {{-- Isi konten halaman --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

