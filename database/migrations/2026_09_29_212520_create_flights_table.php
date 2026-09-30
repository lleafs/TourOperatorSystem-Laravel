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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number')->unique();   // Flight code
            $table->string('origin');                    // Departure city
            $table->string('destination');               // Arrival city
            $table->dateTime('scheduled_time');          // Scheduled departure/arrival
            $table->string('status')->default('Scheduled'); // Status (Scheduled, Delayed, Cancelled)
            $table->string('aircraft')->nullable();      // Aircraft type/model
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
