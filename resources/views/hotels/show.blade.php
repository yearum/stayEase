<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Hotel - {{ $hotel->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <!-- Gambar Hotel -->
        <div class="col-md-6">
            @php
                $images = json_decode($hotel->image, true);
            @endphp

            @if (!empty($images))
                <div id="hotelCarousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $index => $img)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset($img) }}" class="d-block w-100 rounded" alt="Gambar Hotel {{ $index + 1 }}">
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
                <img src="{{ asset('images/default-hotel.jpg') }}" class="img-fluid rounded shadow-sm" alt="{{ $hotel->name }}">
            @endif
        </div>

        <!-- Info Hotel -->
        <div class="col-md-6">
            <h2 class="mb-2">{{ $hotel->name }}</h2>
            <p class="text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $hotel->location }}</p>
            <p><strong>Rating:</strong> {{ $hotel->rating ?? '4.5' }} ⭐</p>
            <p>{{ $hotel->description }}</p>
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
                    <th>Harga Short Time</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hotel->rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->capacity }} Orang</td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <li>3 Jam: Rp{{ number_format($room->price_3h, 0, ',', '.') }}</li>
                                <li>6 Jam: Rp{{ number_format($room->price_6h, 0, ',', '.') }}</li>
                                <li>12 Jam: Rp{{ number_format($room->price_12h, 0, ',', '.') }}</li>
                            </ul>
                        </td>
                        <td>
                            @if($room->is_available)
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Penuh</span>
                            @endif
                        </td>
                        <td>
                            @if($room->is_available)
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pesan Sekarang
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('book.room', ['room' => $room->id, 'duration' => 'short_3h']) }}">3 Jam</a></li>
                                        <li><a class="dropdown-item" href="{{ route('book.room', ['room' => $room->id, 'duration' => 'short_6h']) }}">6 Jam</a></li>
                                        <li><a class="dropdown-item" href="{{ route('book.room', ['room' => $room->id, 'duration' => 'short_12h']) }}">12 Jam</a></li>
                                        <li><a class="dropdown-item" href="{{ route('book.room', ['room' => $room->id, 'duration' => 'transit']) }}">Transit</a></li>
                                        <li><a class="dropdown-item" href="{{ route('book.room', ['room' => $room->id, 'duration' => 'daily']) }}">Daily</a></li>
                                    </ul>
                                </div>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>Penuh</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data kamar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
