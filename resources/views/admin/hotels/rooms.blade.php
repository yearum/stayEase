<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kamar - {{ $hotel->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 0.75rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Kamar untuk Hotel: <strong>{{ $hotel->name }}</strong></h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>

    <!-- ✅ Notifikasi sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ✅ Daftar kamar -->
    @if($rooms->count())
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($rooms as $room)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->type }}</h5>
                    <p class="card-text mb-1"><strong>Kapasitas:</strong> {{ $room->capacity }} orang</p>
                    <p class="card-text mb-1"><strong>Harga:</strong> Rp{{ number_format($room->price, 0, ',', '.') }}</p>
                    <p class="card-text">
                        <strong>Status:</strong>
                        @if($room->is_available)
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Tidak Tersedia</span>
                        @endif
                    </p>

                    <form action="{{ route('admin.rooms.toggle', $room->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-outline-primary mt-2">Ubah Status</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="alert alert-warning">Belum ada kamar terdaftar untuk hotel ini.</div>
    @endif
</div>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
