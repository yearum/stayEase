<!DOCTYPE html>
<html>
<head>
    <title>Form Pemesanan Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f8f9fa;">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center text-primary mb-4">Form Pemesanan Hotel</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('bookings.store', $hotel->id) }}">
            @csrf

            <!-- Pilihan Kamar -->
            <div class="mb-3">
                <label for="room_id" class="form-label">Pilih Kamar</label>
                <select name="room_id" id="room_id" class="form-select" required>
                    <option value="">-- Pilih Kamar --</option>
                    @foreach ($hotel->rooms as $room)
                        <option value="{{ $room->id }}">
                            {{ $room->room_type }} 
                            ({{ $room->type == 'vip' ? 'VIP' : 'Reguler' }}) 
                            - Kapasitas: {{ $room->capacity }} 
                            - Rp{{ number_format($room->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Check-in -->
            <div class="mb-3">
                <label for="checkin" class="form-label">Tanggal Check-in</label>
                <input type="date" name="checkin" id="checkin" class="form-control" required>
            </div>

            <!-- Check-out -->
            <div class="mb-3">
                <label for="checkout" class="form-label">Tanggal Check-out</label>
                <input type="date" name="checkout" id="checkout" class="form-control" required>
            </div>

            <!-- Tombol -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
