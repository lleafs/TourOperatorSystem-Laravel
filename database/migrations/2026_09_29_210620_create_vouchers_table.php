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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();        // Voucher code
            $table->string('type');                  // Type (e.g., flight, hotel, tour)
            $table->date('issue_date');              // Date issued
            $table->date('expiry_date');             // Expiration date
            $table->bigInteger('amount');        // Value of voucher
            $table->string('currency', 10)->default('CLP'); // Currency
            $table->string('customer');              // Customer name
            $table->text('notes')->nullable();       // Optional notes

            // New foreign key to agencies
            $table->foreignId('agency_id')->constrained('agencies');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
