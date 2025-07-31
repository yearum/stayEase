<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Detail Booking</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">
                {{ $booking->room->name }} - {{ $booking->room->hotel->name }}
            </h5>
            <p class="card-text"><strong>Alamat Hotel:</strong> {{ $booking->room->hotel->address }}</p>
            <p class="card-text"><strong>Tanggal Check-in:</strong> {{ \Carbon\Carbon::parse($booking->checkin)->format('d M Y') }}</p>
            <p class="card-text"><strong>Tanggal Check-out:</strong> {{ \Carbon\Carbon::parse($booking->checkout)->format('d M Y') }}</p>
            <p class="card-text"><strong>Total:</strong> Rp{{ number_format($booking->total, 0, ',', '.') }}</p>
            <p class="card-text"><strong>Status:</strong> 
                <span class="badge bg-warning text-dark">{{ ucfirst($booking->status) }}</span>
            </p>
        </div>
    </div>

    @if ($booking->status === 'pending')
        <div class="mt-4">
            <a href="{{ route('bookings.payment', $booking) }}" class="btn btn-primary">Lanjut ke Pembayaran</a>
        </div>
    @endif

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

</body>
</html>
