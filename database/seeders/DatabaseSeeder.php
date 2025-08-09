<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Jalankan semua seeder
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            HotelSeeder::class,
            RoomSeeder::class,
            ReviewSeeder::class,
            BookingSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
