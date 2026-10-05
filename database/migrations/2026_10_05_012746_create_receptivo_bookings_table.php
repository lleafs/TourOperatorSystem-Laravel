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

    // Relaciones mínimas
    $table->foreignId('agency_id')->constrained()->onDelete('cascade');
  
    // Campos básicos
    $table->date('booking_date');
    $table->string('status'); // pending, confirmed, cancelled
    $table->string('hotel_name');
    $table->date('check_in');
    $table->date('check_out');
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
