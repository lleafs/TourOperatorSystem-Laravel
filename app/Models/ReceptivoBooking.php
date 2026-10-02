<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptivoBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'booking_date',
        'status',
        'customer_name',
        'customer_email',
        'hotel_name',
        'hotel_city',
        'hotel_timing',
        'check_in',
        'check_out',
        'notes',
        'total_amount',
    ];
}
