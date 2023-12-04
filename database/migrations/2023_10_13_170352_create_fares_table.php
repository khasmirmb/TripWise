<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ferry_id')->constrained('ferries')->onDelete('restrict'); // Foreign key to relate fares to ferries
            $table->string('type');
            $table->decimal('price', 10, 2);
            $table->integer('seats');
            $table->string('fare_image1')->nullable();
            $table->string('fare_image2')->nullable();
            $table->string('fare_image3')->nullable();
            // Other fare-related fields can be added here

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fares');
    }
};
