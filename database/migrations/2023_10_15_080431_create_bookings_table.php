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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('restrict'); // Foreign key to relate 
            $table->foreignId('contact_person_id')->constrained('contact_persons')->onDelete('restrict'); // Foreign key to relate 
            $table->foreignId('payment_id')->constrained('payments')->onDelete('restrict'); // Foreign key to relate can be null because of OTC payment
            $table->string('trip_type');
            $table->string('status'); // Status (e.g., Pending, Confirmed, Cancelled)
            $table->string('reference_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
