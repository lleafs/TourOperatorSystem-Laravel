<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'booking_date',
        'travel_date',
        'status',
        'customer_name',
        'customer_email',
        'departure_country_id',
        'departure_city_id',
        'airport_id',
        'hotel_timing',
        'hotel_name',
        'hotel_city',
        'check_in',
        'check_out',
        'notes',
        'total_amount',
        'voucher_id',
        'hotel_id',
        'flight_id',
    ];

    // Relationships (optional, if you want Eloquent relations)
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'departure_city_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'departure_country_id');
    }
    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
