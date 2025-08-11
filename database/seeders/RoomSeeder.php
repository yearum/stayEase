<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Hotel;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil satu hotel secara acak dari database
        $hotelId = Hotel::inRandomOrder()->first()?->id;

        // Pastikan hotel ditemukan
        if (!$hotelId) {
            $this->command->warn('Tidak ada hotel yang tersedia. RoomSeeder dilewati.');
            return;
        }

        Room::create([
            'hotel_id' => $hotelId,
            'name' => 'eksklusif',
            'price_3h' => 150000,
            'price_6h' => 250000,
            'price_12h' => 350000,
            'price_transit' => 200000,
            'price_daily' => 500000,
            'available' => true,
        ]);
    }
}

