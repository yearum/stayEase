<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Tambahkan kolom hanya jika belum ada
            if (!Schema::hasColumn('rooms', 'room_type')) {
                $table->string('room_type')->after('hotel_id')->nullable();
            }

            if (!Schema::hasColumn('rooms', 'type')) {
                $table->string('type')->after('room_type')->nullable(); // vip/reguler
            }

            if (!Schema::hasColumn('rooms', 'available')) {
                $table->boolean('available')->default(true)->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
};
