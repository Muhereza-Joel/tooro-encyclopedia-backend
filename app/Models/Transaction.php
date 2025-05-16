<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'currency',
        'amount',
        'status',
        'referenceNo',
        'trackingId',
        'paymentMethod',
        'booking_id',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
