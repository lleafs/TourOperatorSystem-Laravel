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

            // Core booking info
            $table->string('customer_name');
            $table->string('customer_email');
            $table->date('booking_date');
            $table->date('travel_date')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('status')->default('pending'); // pending, confirmed, cancelled

            // Relationships
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->foreignId('voucher_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('hotel_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('flight_id')->nullable()->constrained()->onDelete('set null');

            // Departure info (fix)
            $table->foreignId('departure_country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->foreignId('departure_city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->foreignId('airport_id')->nullable()->constrained('airports')->onDelete('set null');

            $table->foreignId('continent_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');

            // Hotel details
            $table->string('hotel_timing'); // pre_flight, arrival, other
            $table->string('hotel_name');
            $table->string('hotel_city')->nullable();
            $table->date('check_in');
            $table->date('check_out');

            // Notes
            $table->text('notes')->nullable();

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
