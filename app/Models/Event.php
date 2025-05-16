<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'price',
        'capacity',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
