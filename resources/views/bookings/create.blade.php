<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-primary mb-4">Form Pemesanan Hotel</h2>

        <!-- Pesan Sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Validasi Error -->
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

        <!-- Form Booking -->
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

            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-select" onchange="toggleRekening(this.value)" required>
                    <option value="">-- Pilih --</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="cod">Bayar di Tempat (COD)</option>
                </select>
            </div>

            <!-- Info Transfer -->
            <div class="alert alert-info d-none" id="rekening-info">
                Silakan transfer ke rekening berikut:<br>
                <strong>BCA 6975701828</strong><br>
                Atas Nama: <strong>[Nama Pemilik]</strong>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleRekening(value) {
        const info = document.getElementById('rekening-info');
        if (value === 'transfer') {
            info.classList.remove('d-none');
        } else {
            info.classList.add('d-none');
        }
    }
</script>
</body>
</html>
