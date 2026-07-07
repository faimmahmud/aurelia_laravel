@extends('layouts.master')

@php($pageTitle = 'Admin Dashboard | Aurelia Travel')

@section('content')
<section class="arc-section arc-top">
  <div class="container">
    <div class="section-kicker">Admin</div>
    <h1 class="section-title mb-4">Booking dashboard</h1>

    <div class="row g-3 mb-4">
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light">
          <div class="text-muted small text-uppercase">Total bookings</div>
          <div class="fs-3 fw-bold">{{ $stats['total'] }}</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light">
          <div class="text-muted small text-uppercase">Pending review</div>
          <div class="fs-3 fw-bold">{{ $stats['pending'] }}</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light">
          <div class="text-muted small text-uppercase">Confirmed</div>
          <div class="fs-3 fw-bold">{{ $stats['confirmed'] }}</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light">
          <div class="text-muted small text-uppercase">Revenue (paid)</div>
          <div class="fs-3 fw-bold">${{ number_format($stats['revenue'], 2) }}</div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="h5 mb-0">Recent bookings</h2>
      <a href="{{ route('admin.bookings') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">View all bookings</a>
    </div>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Customer</th>
            <th>Package</th>
            <th>Travel date</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($bookings as $b)
          <tr>
            <td>{{ $b->booking_ref }}</td>
            <td>{{ $b->customer_name }}<br><span class="text-muted small">{{ $b->customer_email }}</span></td>
            <td>{{ $b->package_name }}</td>
            <td>{{ $b->travel_date }}</td>
            <td>{{ $b->currency }} {{ number_format($b->amount, 2) }}</td>
            <td><span class="badge bg-{{ $b->paymentBadgeClass() }}">{{ $b->payment_status }}</span></td>
            <td><span class="badge bg-{{ $b->statusBadgeClass() }}">{{ $b->booking_status }}</span></td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-center text-muted py-4">No bookings yet.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
    {{ $bookings->links() }}
  </div>
</section>
@endsection
