<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

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

        <!-- Informasi Kamar -->
        <h4 class="mb-3">Booking Kamar: {{ $room->name }}</h4>
        <p><strong>Durasi:</strong> {{ strtoupper(str_replace('_', ' ', $duration)) }}</p>
        <p><strong>Harga:</strong> Rp{{ number_format($price, 0, ',', '.') }}</p>

        <!-- Form Booking -->
        <form action="{{ route('bookings.store') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="duration" value="{{ $duration }}">
            <input type="hidden" name="price" value="{{ $price }}">

            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-select" onchange="toggleRekening(this.value)" required>
                    <option value="">-- Pilih --</option>
                    <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Bayar di Tempat (COD)</option>
                </select>
            </div>

            <!-- Info Transfer -->
            <div class="alert alert-info {{ old('payment_method') == 'transfer' ? '' : 'd-none' }}" id="rekening-info">
                <strong>Silakan transfer ke rekening berikut:</strong><br>
                <span>6975701828 - BCA</span><br>
                <span>Atas Nama: <strong>Galang Samudra</strong></span>
                <p class="text-muted mt-2" style="font-size: 0.875em;">
                    *Sertakan bukti pembayaran ke resepsionis saat check-in.
                </p>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">Bayar Sekarang</button>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk toggle rekening info -->
<script>
    function toggleRekening(value) {
        const info = document.getElementById('rekening-info');
        if (value === 'transfer') {
            info.classList.remove('d-none');
        } else {
            info.classList.add('d-none');
        }
    }

    // Tampilkan rekening saat reload jika sebelumnya pilih "transfer"
    window.onload = function () {
        const selected = document.querySelector('select[name="payment_method"]').value;
        toggleRekening(selected);
    };
</script>
</body>
</html>
