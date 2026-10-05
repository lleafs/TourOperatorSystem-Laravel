<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $appends = ['full_name'];

    // Table name is inferred as "customers"
    protected $table = 'customers';

    // Allow mass assignment for these fields
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
    ];

    /**
     * Accessor for full name
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function bookings()
    {
        return $this->belongsToMany(ReceptivoBooking::class, 'booking_customer');
    }
}
