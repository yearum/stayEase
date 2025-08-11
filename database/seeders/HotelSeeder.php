<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Photo;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $hotels = [
            [
                'name' => 'Ambarukmo',
                'location' => 'Yogyakarta',
                'description' => 'Hotel mewah di pusat kota dengan akses langsung ke mall dan fasilitas lengkap.',
                'images' => [
                    'images/amplas/Gambar WhatsApp 2025-08-09 pukul 14.11.03_4dcc793c.jpg',
                    'images/amplas/Gambar WhatsApp 2025-08-09 pukul 14.11.03_cd6e0a70.jpg',
                ],
            ],
            [
                'name' => 'Apartement Student Castle',
                'location' => 'Yogyakarta',
                'description' => 'Apartemen modern untuk pelajar dan wisatawan, dekat kampus dan pusat kuliner.',
                'images' => [
                    'images/apart/Gambar WhatsApp 2025-08-09 pukul 14.07.33_91adaad1.jpg',
                    'images/apart/Gambar WhatsApp 2025-08-09 pukul 14.07.34_40401799.jpg',
                ],
            ],
            [
                'name' => 'Mrican',
                'location' => 'Yogyakarta',
                'description' => 'Penginapan nyaman di area tenang, cocok untuk transit dan liburan hemat.',
                'images' => [
                    'images/mrican/m3.jpg',
                    'images/mrican/m2.jpg',
                    'images/mrican/m1.jpg',
                ],
            ],
        ];

        foreach ($hotels as $data) {
            $hotel = Hotel::create([
                'name' => $data['name'],
                'location' => $data['location'],
                'description' => $data['description'],
                
            ]);

            foreach ($data['images'] as $path) {
                Photo::create([
                    'hotel_id' => $hotel->id,
                    'image_path' => $path, // ✅ Sudah cocok dengan migration
                ]);
            }
        }
    }
}
