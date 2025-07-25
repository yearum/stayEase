<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ✅ Tambahkan ini kalau model-model sudah ada
use App\Models\Room;
use App\Models\Photo;
use App\Models\Facility;
use App\Models\Review;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'rating',
        'image'
    ];

    // Relasi ke tabel rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Relasi ke tabel photos
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Relasi ke tabel facilities
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    // Relasi ke tabel reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
