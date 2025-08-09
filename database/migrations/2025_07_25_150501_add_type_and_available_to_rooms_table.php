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
            if (!Schema::hasColumn('rooms', 'room_type')) {
                $table->string('room_type')->nullable()->after('hotel_id');
            }

            if (!Schema::hasColumn('rooms', 'available')) {
                $table->boolean('available')->default(true)->after('room_type');
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

            if (Schema::hasColumn('rooms', 'available')) {
                $table->dropColumn('available');
            }
        });
    }
};
