<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id', 64)->primary();
            $table->string('booking_ref', 40)->unique();
            $table->string('booking_type', 30)->default('package');
            $table->string('package_id', 64)->nullable();
            $table->string('package_name', 190);
            $table->string('country', 120)->default('');
            $table->string('departure_from', 120)->default('');
            $table->string('destination', 120)->default('');
            $table->date('travel_date')->nullable();
            $table->time('travel_time')->nullable();
            $table->date('leave_date')->nullable();
            $table->time('leave_time')->nullable();
            $table->unsignedInteger('guests')->default(1);
            $table->string('customer_name', 150);
            $table->string('customer_email', 190)->index();
            $table->string('customer_phone', 60);
            $table->string('payment_method', 40)->default('cash');
            $table->string('payment_provider', 40)->default('')->index();
            $table->string('gateway_reference', 190)->default('');
            $table->string('payment_reference', 190)->default('');
            $table->string('idempotency_key', 80)->default('');
            $table->string('payment_status', 40)->default('unpaid')->index();
            $table->string('booking_status', 40)->default('pending_review')->index();
            $table->string('approval_status', 40)->default('pending')->index();
            $table->decimal('amount', 12, 2)->default(0);
            $table->char('currency', 3)->default('USD');
            $table->text('admin_note')->nullable();
            $table->text('message')->nullable();
            $table->string('booked_by', 190)->default('guest');
            $table->string('booked_role', 40)->default('guest');
            $table->string('booking_channel', 40)->default('website');
            $table->string('ip_address', 45)->default('');
            $table->string('user_agent', 255)->default('');
            $table->string('approved_by', 190)->default('');
            $table->dateTime('approved_at')->nullable();
            $table->string('rejected_by', 190)->default('');
            $table->dateTime('rejected_at')->nullable();
            $table->dateTime('contacted_at')->nullable();
            $table->dateTime('last_notified_at')->nullable();
            $table->unsignedInteger('notification_count')->default(0);
            $table->timestamps();
            $table->index('created_at');
            $table->index('booking_type');
        });

        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id', 64)->index();
            $table->string('provider', 40)->default('')->index();
            $table->string('payment_method', 40)->default('');
            $table->decimal('amount', 12, 2)->default(0);
            $table->char('currency', 3)->default('USD');
            $table->string('status', 40)->default('pending')->index();
            $table->string('gateway_reference', 190)->default('');
            $table->string('idempotency_key', 80)->default('');
            $table->json('payload_json')->nullable();
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });

        Schema::create('booking_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id', 64)->index();
            $table->enum('audience', ['admin', 'customer'])->default('admin');
            $table->enum('channel', ['in_app', 'email', 'sms'])->default('in_app');
            $table->string('action_type', 50)->default('booking_created');
            $table->string('title', 190);
            $table->text('body');
            $table->enum('status', ['unread', 'read'])->default('unread');
            $table->dateTime('read_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->index(['audience', 'status']);
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });

        Schema::create('booking_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id', 64)->index();
            $table->string('actor_email', 190)->default('');
            $table->string('actor_role', 40)->default('system');
            $table->string('action_type', 50)->default('')->index();
            $table->string('old_status', 40)->default('');
            $table->string('new_status', 40)->default('');
            $table->text('details')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_audit_logs');
        Schema::dropIfExists('booking_notifications');
        Schema::dropIfExists('payment_transactions');
        Schema::dropIfExists('bookings');
    }
};
