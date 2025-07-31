<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1>Selamat Datang di Dashboard</h1>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <p class="mt-3">Silakan lanjutkan aktivitas Anda.</p>
        <a href="{{ route('bookings.index') }}" class="btn btn-primary mt-3">Lihat Booking</a>
    </div>
</body>
</html>
