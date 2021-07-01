<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    protected $fillable = [
        'title', 'description',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function availableFor($from, $to): bool
    {
        return $this->bookings()->betweenDates($from, $to)->count();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
