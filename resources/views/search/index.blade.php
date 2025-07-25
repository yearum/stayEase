<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Hasil Pencarian Hotel</h2>

        @if(isset($hotels) && $hotels->count())
            <p class="mb-3 text-muted">
                Menampilkan penginapan di <strong>{{ $destination }}</strong>
                untuk <strong>{{ $guests }} tamu</strong> dari <strong>{{ $checkin }}</strong> sampai <strong>{{ $checkout }}</strong>
            </p>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($hotels as $hotel)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            {{-- ✅ Gambar Hotel --}}
                            <img src="{{ asset($hotel->image ?? 'images/default-hotel.jpg') }}" class="card-img-top" alt="{{ $hotel->name }}">

                            <div class="card-body">
                                <h5 class="card-title">{{ $hotel->name }}</h5>
                                <p class="text-muted mb-1">{{ $hotel->location }}</p>
                                <p class="card-text">{{ Str::limit($hotel->description, 100) }}</p>
                                <p><strong>Rp{{ number_format($hotel->price_per_night, 0, ',', '.') }}</strong> / malam</p>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                                <span class="badge bg-success">{{ $hotel->rating ?? '4.5' }} ⭐</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning mt-4">
                Tidak ada hotel ditemukan untuk pencarian ini.
            </div>
        @endif
    </div>
</body>
</html>
