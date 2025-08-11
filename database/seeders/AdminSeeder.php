<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin; // ← Ini penting!

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder admin
     */
    public function run(): void
    {
      //  Admin::create([
       //     'username' => '',
        //    'password' => Hash::make(''),
       //]);
    }
}
