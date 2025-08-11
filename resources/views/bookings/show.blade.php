<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-primary">Detail Booking</h2>

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
            <p class="card-text"><strong>Durasi:</strong> {{ $booking->formatted_duration }}</p>
            <p class="card-text"><strong>Total Terformat:</strong> {{ $booking->formatted_total }}</p>
            <p class="card-text"><strong>Check-in Detail:</strong> {{ $booking->checkin->format('d M Y H:i') }}</p>
            <p class="card-text"><strong>Tanggal Check-in:</strong> {{ \Carbon\Carbon::parse($booking->checkin)->format('d M Y') }}</p>
            <p class="card-text"><strong>Tanggal Check-out:</strong> {{ \Carbon\Carbon::parse($booking->checkout)->format('d M Y') }}</p>
            <p class="card-text"><strong>Total:</strong> Rp{{ number_format($booking->total, 0, ',', '.') }}</p>
            <p class="card-text"><strong>Status:</strong> 
                <span class="badge {{ strtolower($booking->status) === 'success' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ strtolower($booking->status) === 'success' ? '✔️' : '✔️' }} {{ ucfirst($booking->status) }}
                </span>
            </p>
            <p class="card-text"><strong>Metode Pembayaran:</strong> 
                {{ $booking->payment_method === 'transfer' ? 'Transfer Bank' : 'Bayar di Tempat (COD)' }}
            </p>
        </div>
    </div>

    @if ($booking->payment_method === 'transfer')
        <div class="alert alert-info mt-4">
            <strong>Silakan transfer ke rekening berikut:</strong><br>
            <span>6975701828 - BCA</span><br>
            <span>Atas Nama: <strong>Galang Samudra</strong></span>
            <p class="text-muted mt-2" style="font-size: 0.875em;">
                *Sertakan bukti pembayaran ke resepsionis saat check-in.
            </p>
        </div>
    @endif
</div>

</body>
</html>
