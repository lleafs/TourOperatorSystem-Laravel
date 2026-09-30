<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_email',
        'booking_date',
        'travel_date',
        'total_amount',
        'status',
        'agency_id',
        'voucher_id',
        'hotel_id',
        'flight_id',

    ];
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
