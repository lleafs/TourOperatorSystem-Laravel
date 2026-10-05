<?php

// app/Models/Airport.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iata',
        'icao',
        'city',
        'state',
        'county',
        'country',
        'city_code',
        'latitude',
        'longitude',
        'elevation',
        'time_zone',
        'url',
        'type',
        'CityId',
    ];

        // Define pivot relationship
    public function airlines()
    {
        return $this->belongsToMany(Airline::class, 'airline_airport');
    }
}
