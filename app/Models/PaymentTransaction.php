<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'booking_id', 'provider', 'payment_method', 'amount', 'currency',
        'status', 'gateway_reference', 'idempotency_key', 'payload_json',
    ];

    protected $casts = [
        'payload_json' => 'array',
        'amount' => 'float',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
