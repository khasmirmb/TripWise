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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); 
            $table->decimal('payment_amount', 10, 2);
            $table->decimal('depart_total', 10, 2);
            $table->decimal('return_total', 10, 2);
            $table->decimal('discount_total', 10, 2);
            $table->decimal('service_total', 10, 2);
            $table->date('payment_date')->nullable();
            $table->string('payment_method');
            $table->string('payment_status'); // e.g., Successful, Pending, Failed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
