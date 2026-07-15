@extends('layouts.admin')

@php($pageTitle = 'Booking ' . $booking->booking_ref . ' | Aurelia Travel')

@section('content')
<section class="arc-section arc-top">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <div class="section-kicker">Admin</div>
        <h1 class="section-title mb-0">Booking {{ $booking->booking_ref }}</h1>
      </div>
      <a href="{{ route('admin.bookings') }}" class="btn btn-outline-dark px-4">Back to bookings</a>
    </div>

    <div class="row g-4">
      <div class="col-lg-7">
        <div class="form-shell p-4 p-lg-5 reveal">
          <h2 class="h5 mb-3">Trip details</h2>
          <dl class="row mb-0">
            <dt class="col-5 text-muted">Package</dt><dd class="col-7">{{ $booking->package_name }}</dd>
            <dt class="col-5 text-muted">Country</dt><dd class="col-7">{{ $booking->country ?: '—' }}</dd>
            <dt class="col-5 text-muted">Travel date</dt><dd class="col-7">{{ $booking->travel_date }} {{ $booking->travel_time }}</dd>
            <dt class="col-5 text-muted">Return date</dt><dd class="col-7">{{ $booking->leave_date }} {{ $booking->leave_time }}</dd>
            <dt class="col-5 text-muted">Guests</dt><dd class="col-7">{{ $booking->guests }}</dd>
            <dt class="col-5 text-muted">Message</dt><dd class="col-7">{{ $booking->message ?: '—' }}</dd>
          </dl>
        </div>

        <div class="form-shell p-4 p-lg-5 reveal mt-4">
          <h2 class="h5 mb-3">Customer</h2>
          <dl class="row mb-0">
            <dt class="col-5 text-muted">Name</dt><dd class="col-7">{{ $booking->customer_name }}</dd>
            <dt class="col-5 text-muted">Email</dt><dd class="col-7">{{ $booking->customer_email }}</dd>
            <dt class="col-5 text-muted">Phone</dt><dd class="col-7">{{ $booking->customer_phone }}</dd>
            <dt class="col-5 text-muted">Booked by</dt><dd class="col-7">{{ $booking->booked_by }} ({{ $booking->booked_role }})</dd>
            <dt class="col-5 text-muted">IP / agent</dt><dd class="col-7">{{ $booking->ip_address }}<br><span class="small text-muted">{{ $booking->user_agent }}</span></dd>
          </dl>
        </div>

        <div class="form-shell p-4 p-lg-5 reveal mt-4">
          <h2 class="h5 mb-3">Activity log</h2>
          @forelse ($booking->auditLogs as $log)
            <div class="border-bottom py-2 small">
              <strong>{{ $log->action_type }}</strong>
              @if ($log->old_status || $log->new_status)
                — {{ $log->old_status ?: '—' }} → {{ $log->new_status ?: '—' }}
              @endif
              <span class="text-muted"> by {{ $log->actor_email ?: 'system' }} ({{ $log->actor_role }})</span>
              <div class="text-muted">{{ $log->created_at }}</div>
            </div>
          @empty
            <p class="text-muted small mb-0">No activity recorded yet.</p>
          @endforelse
        </div>
      </div>

      <div class="col-lg-5">
        <div class="form-shell p-4 p-lg-5 reveal">
          <h2 class="h5 mb-3">Payment & status</h2>
          <dl class="row mb-3">
            <dt class="col-6 text-muted">Amount</dt><dd class="col-6">{{ $booking->currency }} {{ number_format($booking->amount, 2) }}</dd>
            <dt class="col-6 text-muted">Payment method</dt><dd class="col-6">{{ $booking->payment_method }}</dd>
            <dt class="col-6 text-muted">Payment reference</dt><dd class="col-6">{{ $booking->payment_reference ?: '—' }}</dd>
            <dt class="col-6 text-muted">Payment status</dt><dd class="col-6"><span class="badge bg-{{ $booking->paymentBadgeClass() }}">{{ $booking->payment_status }}</span></dd>
            <dt class="col-6 text-muted">Booking status</dt><dd class="col-6"><span class="badge bg-{{ $booking->statusBadgeClass() }}">{{ $booking->booking_status }}</span></dd>
          </dl>

          <form action="{{ route('admin.bookings.update', $booking->id) }}" method="post" class="row g-2">
            @csrf
            @method('PATCH')
            <div class="col-8">
              <select name="booking_status" class="form-select">
                @foreach (['pending_review','confirmed','cancelled','rejected'] as $status)
                  <option value="{{ $status }}" @selected($booking->booking_status === $status)>{{ $status }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-4">
              <button class="btn btn-gold w-100">Update</button>
            </div>
          </form>

          <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="post" class="mt-3" onsubmit="return confirm('Delete this booking?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger w-100">Delete booking</button>
          </form>
        </div>

        <div class="form-shell p-4 p-lg-5 reveal mt-4">
          <h2 class="h5 mb-3">Notifications sent</h2>
          @forelse ($booking->notifications as $n)
            <div class="border-bottom py-2 small">
              <strong>{{ $n->title }}</strong>
              <div class="text-muted">{{ $n->body }}</div>
              <div class="text-muted">{{ $n->created_at }} · {{ $n->status }}</div>
            </div>
          @empty
            <p class="text-muted small mb-0">No notifications yet.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
