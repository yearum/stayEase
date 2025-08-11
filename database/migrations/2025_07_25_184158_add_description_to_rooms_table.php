<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Tambahkan kolom description
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Hapus kolom hanya jika ada
            if (Schema::hasColumn('rooms', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
