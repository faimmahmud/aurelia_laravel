<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingNotification extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'booking_id', 'audience', 'channel', 'action_type', 'title', 'body', 'status', 'read_at',
    ];

    protected $attributes = ['created_at' => null];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->created_at = $model->created_at ?? now();
        });
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
