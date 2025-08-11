<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class); // ← Ini relasi ke gambar hotel
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
