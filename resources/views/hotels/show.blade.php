<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Hotel - {{ $hotel->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .carousel-item img {
            height: 350px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row g-4">
        <!-- Gambar Hotel (Carousel) -->
        <div class="col-md-6">
            @if (!empty($hotel->images))
                <div id="hotelCarousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($hotel->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset($image) }}" class="d-block w-100 rounded" alt="Gambar Hotel {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            @else
                <img src="{{ asset($hotel->image ?? 'images/default-hotel.jpg') }}" class="img-fluid rounded shadow-sm" alt="{{ $hotel->name }}">
            @endif
        </div>

        <!-- Info Hotel -->
        <div class="col-md-6">
            <h2 class="mb-2">{{ $hotel->name }}</h2>
            <p class="text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $hotel->location }}</p>
            <p><strong>Rating:</strong> {{ $hotel->rating ?? '4.5' }} ⭐</p>
            <p>{{ $hotel->description }}</p>
            <a href="{{ route('hotels.book', $hotel->id) }}" class="btn btn-success mt-2">Pesan Sekarang</a>
        </div>
    </div>

    <!-- Daftar Kamar -->
    <h4 class="mt-5">Pilihan Kamar</h4>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Nama Kamar</th>
                    <th>Kapasitas</th>
                    <th>Harga per Malam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hotel->rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->capacity }} Orang</td>
                        <td>Rp{{ number_format($room->price, 0, ',', '.') }}</td>
                        <td>
                            @if($room->available)
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Penuh</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data kamar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Form Ulasan -->
    @auth
        <div class="mt-5">
            <h5>Tulis Ulasan</h5>
            <form action="{{ route('hotels.reviews.store', $hotel->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1-5):</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Komentar:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                </div>
                <button class="btn btn-primary">Kirim Ulasan</button>
            </form>
        </div>
    @endauth
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
