<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmisivoBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'booking_date',
        'status',
        'customer_name',
        'customer_email',
        'departure_country_id',
        'departure_city_id',
        'airport_id',
        'notes',
        'total_amount',
    ];
}
