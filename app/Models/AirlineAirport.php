<?php

// app/Models/AirlineAirport.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirlineAirport extends Model
{
    use HasFactory;

    protected $table = 'airline_airport';

    // Usually no $fillable needed, since pivot is managed via belongsToMany
    protected $fillable = [
        'airline_id',
        'airport_id',
    ];
}

