<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    /** @use HasFactory<\Database\Factories\AirlineFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'iata',
        'icao',
        'country',
        'year_created',
        'base',
        'fleet',
        'logo_url',
        'brandmark_url',
        'tail_logo_url',
    ];

    // Example relationship: one airline has many availability records
    public function availabilities()
    {
        return $this->hasMany(CheckAvailability::class);
    }
        // Define pivot relationship
    public function airports()
    {
        return $this->belongsToMany(Airport::class, 'airline_airport');
    }
}
