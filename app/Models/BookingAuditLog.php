<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingAuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'booking_id', 'actor_email', 'actor_role', 'action_type', 'old_status', 'new_status', 'details',
    ];

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
