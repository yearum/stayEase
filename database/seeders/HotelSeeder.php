<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Hotel::factory()
            ->count(10)
            ->create()
            ->each(function ($hotel) {
                // Tambahkan 3-5 room per hotel
                Room::factory()->count(rand(3, 5))->create([
                    'hotel_id' => $hotel->id,
                ]);

                // Tambahkan 2-4 review per hotel
                Review::factory()->count(rand(2, 4))->create([
                    'hotel_id' => $hotel->id,
                ]);
            });
    }
}

