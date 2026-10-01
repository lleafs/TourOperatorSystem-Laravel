<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($country) {
            $country->name_normalized = Str::lower(Str::ascii($country->name));
        });
    }

    protected $fillable = ['name'];
    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
