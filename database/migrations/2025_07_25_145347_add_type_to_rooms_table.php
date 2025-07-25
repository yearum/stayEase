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
        $table->string('room_type')->after('hotel_id')->nullable();
    });
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('type')->after('room_type')->nullable(); // vip/reguler
            $table->boolean('available')->default(true)->after('description');
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
        $table->dropColumn('room_type');
    });
    }
};
