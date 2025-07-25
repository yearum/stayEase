<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">BookingHotel</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Daftar Hotel</h2>
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $hotel->image ?? 'https://via.placeholder.com/400x250?text=Hotel+Image' }}" class="card-img-top" alt="{{ $hotel->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="card-text text-muted">{{ $hotel->location }}</p>
                            <p class="card-text">{{ Str::limit($hotel->description, 80) }}</p>
                            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-light text-center text-muted py-3 mt-5 border-top">
        <div class="container">
            &copy; {{ date('Y') }} BookingHotel. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
