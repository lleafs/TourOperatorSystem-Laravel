<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    /** @use HasFactory<\Database\Factories\FlightFactory> */
    use HasFactory;
    protected $casts = [
        'scheduled_time' => 'datetime',
    ];

    protected $fillable = [
        'flight_number',
        'origin',
        'destination',
        'scheduled_time',
        'status',
        'aircraft',
    ];
}

