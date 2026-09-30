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
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iata', 2)->nullable();
            $table->string('icao', 3)->nullable();
            $table->string('country')->nullable();
            $table->string('year_created')->nullable();
            $table->string('base')->nullable();
            $table->json('fleet')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('brandmark_url')->nullable();
            $table->string('tail_logo_url')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airlines');
    }
};
