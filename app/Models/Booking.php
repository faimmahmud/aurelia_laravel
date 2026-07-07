<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'booking_ref', 'booking_type', 'package_id', 'package_name',
        'country', 'departure_from', 'destination', 'travel_date', 'travel_time',
        'leave_date', 'leave_time', 'guests', 'customer_name', 'customer_email',
        'customer_phone', 'payment_method', 'payment_provider', 'gateway_reference',
        'payment_reference', 'idempotency_key', 'payment_status', 'booking_status',
        'approval_status', 'amount', 'currency', 'admin_note', 'message',
        'booked_by', 'booked_role', 'booking_channel', 'ip_address', 'user_agent',
        'approved_by', 'approved_at', 'rejected_by', 'rejected_at', 'contacted_at',
        'last_notified_at', 'notification_count',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public function notifications()
    {
        return $this->hasMany(BookingNotification::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(BookingAuditLog::class);
    }

    public function statusBadgeClass(): string
    {
        return match ($this->booking_status) {
            'confirmed' => 'success',
            'pending_review' => 'warning',
            'cancelled', 'rejected' => 'danger',
            default => 'secondary',
        };
    }

    public function paymentBadgeClass(): string
    {
        return match ($this->payment_status) {
            'paid' => 'success',
            'pending_verification' => 'warning',
            'unpaid' => 'secondary',
            default => 'secondary',
        };
    }
}
