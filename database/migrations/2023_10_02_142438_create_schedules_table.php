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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ferry_id')->constrained('ferries'); // Foreign key to relate schedules to ferries
            $table->string('departure_port');
            $table->string('arrival_port');
            $table->dateTime('departure_time'); // Using timestamp for date and time
            $table->dateTime('arrival_time');
            // Other schedule-related fields can be added here
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
