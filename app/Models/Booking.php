<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'quantity',
        'status',
        'reference_number', // Unique reference number for the booking
        'order_tracking_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
