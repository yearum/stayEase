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
    $table->decimal('price_3h', 10, 2)->nullable();
    $table->decimal('price_6h', 10, 2)->nullable();
    $table->decimal('price_12h', 10, 2)->nullable();
    $table->decimal('price_transit', 10, 2)->nullable();
    $table->decimal('price_daily', 10, 2)->nullable();

    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
