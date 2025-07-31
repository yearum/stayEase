<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Daftar Booking Anda</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Hotel</th>
                <th>Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->room->hotel->name }}</td>
                    <td>{{ $booking->room->name }}</td>
                    <td>{{ $booking->checkin }}</td>
                    <td>{{ $booking->checkout }}</td>
                    <td>Rp{{ number_format($booking->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada booking.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
