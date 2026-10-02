<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmisivoBooking extends Model
{
    use HasFactory;

    protected $table = 'emisivo_bookings';

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

    public function departureCountry()
    {
        return $this->belongsTo(Country::class, 'departure_country_id');
    }

    public function departureCity()
    {
        return $this->belongsTo(City::class, 'departure_city_id');
    }

    public function airport()
    {
        return $this->belongsTo(Airport::class, 'airport_id');
    }
}
