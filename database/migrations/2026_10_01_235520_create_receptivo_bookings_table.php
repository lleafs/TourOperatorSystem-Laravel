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
        Schema::create('receptivo_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained();
            $table->date('booking_date');
            $table->string('status')->default('pending');
            $table->string('customer_name');
            $table->string('customer_email');
            // Hotel/tour‑centric fields
            $table->string('hotel_name');
            $table->string('hotel_city')->nullable();
            $table->enum('hotel_timing', ['pre_flight', 'arrival', 'other']);
            $table->date('check_in');
            $table->date('check_out');
            $table->text('notes')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receptivo_bookings');
    }
};
