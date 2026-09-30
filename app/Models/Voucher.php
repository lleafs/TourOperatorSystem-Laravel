<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    /** @use HasFactory<\Database\Factories\VoucherFactory> */
    use HasFactory;
    protected $fillable = [
        'code',
        'type',
        'issue_date',
        'expiry_date',
        'amount',
        'currency',
        'customer',
        'notes',
        'agency_id',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
