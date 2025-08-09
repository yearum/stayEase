<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run()
    {
        Hotel::create([
            'name' => 'Ambarukmo',
            'location' => 'Yogyakarta',
            'description' => 'Hotel mewah di pusat kota Yogyakarta.',
            
        ]);

        Hotel::create([
            'name' => 'Apartemen Studen Kastel',
            'location' => 'Yogyakarta',
            'description' => 'Apartemen nyaman untuk mahasiswa.',
            
        ]);
    }
}
