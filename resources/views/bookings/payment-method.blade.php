<!DOCTYPE html>
<html>
<head>
    <title>Pilih Metode Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Pilih Metode Pembayaran</h2>

    <form action="{{ route('bookings.pay', $booking->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-select" required onchange="toggleInfo()">
                <option value="">-- Pilih --</option>
                <option value="Transfer">Transfer Bank</option>
                <option value="COD">Bayar di Tempat (COD)</option>
            </select>
        </div>

        {{-- Transfer Info --}}
        <div id="transfer-info" class="mb-3" style="display: none;">
    <label class="form-label">Nomor Rekening:</label>
    <p><strong>6975701828 - BCA</strong> a.n. Galang S</p>
    <small class="text-danger">*Sertakan bukti pembayaran ke resepsionis saat check-in.</small>
</div>


        <button type="submit" class="btn btn-success">Bayar Sekarang</button>
    </form>
</div>

<script>
    function toggleInfo() {
        const method = document.getElementById('payment_method').value;
        document.getElementById('transfer-info').style.display = method === 'Transfer' ? 'block' : 'none';
    }
</script>

</body>
</html>
