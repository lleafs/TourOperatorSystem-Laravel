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
        'hotel_name',
        'check_in',
        'check_out',
        'total_amount',
    ];


    // Relaciones básicas
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'booking_customer');
    }
}
