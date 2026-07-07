@extends('layouts.master')

@php($pageTitle = 'My Dashboard | Aurelia Travel')

@section('content')
<section class="arc-section arc-top">
  <div class="container">
    <div class="section-kicker">Account</div>
    <h1 class="section-title mb-4">Welcome, {{ auth()->user()->name }}</h1>

    @php($myBookings = \App\Models\Booking::where('customer_email', auth()->user()->email)->latest()->get())

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Package</th>
            <th>Travel date</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($myBookings as $b)
          <tr>
            <td>{{ $b->booking_ref }}</td>
            <td>{{ $b->package_name }}</td>
            <td>{{ $b->travel_date }}</td>
            <td>{{ $b->currency }} {{ number_format($b->amount, 2) }}</td>
            <td><span class="badge bg-{{ $b->paymentBadgeClass() }}">{{ $b->payment_status }}</span></td>
            <td><span class="badge bg-{{ $b->statusBadgeClass() }}">{{ $b->booking_status }}</span></td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted py-4">You haven't made a booking yet.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <a href="{{ route('booking.create') }}" class="btn btn-gold px-4 mt-3">Book a new trip</a>
  </div>
</section>
@endsection
