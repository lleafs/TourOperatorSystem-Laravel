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
        Schema::create('emisivo_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained();
            $table->date('booking_date');
            $table->string('status')->default('pending');
            $table->string('customer_name');
            $table->string('customer_email');

            // Flight‑centric fields
            $table->foreignId('departure_country_id')->nullable()->constrained('countries');
            $table->foreignId('departure_city_id')->nullable()->constrained('cities');
            $table->foreignId('airport_id')->nullable()->constrained('airports');

            // New: departure flight reference
            $table->foreignId('departure_flight_id')
                ->nullable()
                ->constrained('flights')
                ->onDelete('set null');

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
        Schema::dropIfExists('emisivo_bookings');
    }
};
