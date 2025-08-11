<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class AddRoomTypeToRoomsTable extends Migration

{
    public function up(): void
    {
        // Cek kolom di luar closure
        $hasRoomType = Schema::hasColumn('rooms', 'room_type');
        $hasType = Schema::hasColumn('rooms', 'type');
        $hasAvailable = Schema::hasColumn('rooms', 'available');

        Schema::table('rooms', function (Blueprint $table) use ($hasRoomType, $hasType, $hasAvailable) {
            if (!$hasRoomType) {
                $table->string('room_type')->nullable()->after('hotel_id');
            }

            if (!$hasType) {
                $table->string('type')->nullable()->after('room_type'); // vip/reguler
            }

            if (!$hasAvailable) {
                $table->boolean('available')->default(true); // Hapus after('description')
            }
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'room_type')) {
                $table->dropColumn('room_type');
            }

            if (Schema::hasColumn('rooms', 'type')) {
                $table->dropColumn('type');
            }

            if (Schema::hasColumn('rooms', 'available')) {
                $table->dropColumn('available');
            }
        });
    }
}
