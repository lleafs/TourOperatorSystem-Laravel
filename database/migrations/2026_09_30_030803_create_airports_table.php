<?php

// database/migrations/2026_06_24_233949_create_airports_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iata', 3)->unique();   // e.g. ORD, BEY, SCL
            $table->string('icao', 4)->unique();   // e.g. KORD, OLBA, SCEL
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('city_code')->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->integer('elevation')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->nullable();    // e.g. AP
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('airports');
    }
};
