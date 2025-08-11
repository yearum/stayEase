<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();
            $table->boolean('is_available')->default(true);
            $table->decimal('price_3h', 10, 2)->nullable();
            $table->decimal('price_6h', 10, 2)->nullable();
            $table->decimal('price_12h', 10, 2)->nullable();
            $table->decimal('price_transit', 10, 2)->nullable();
            $table->decimal('price_daily', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
}
