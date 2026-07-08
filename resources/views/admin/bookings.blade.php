@extends('layouts.master')

@php($pageTitle = 'Manage Bookings | Aurelia Travel')

@section('content')
<section class="arc-section arc-top">
  <div class="container">
    <div class="section-kicker">Admin</div>
    <h1 class="section-title mb-4">All bookings</h1>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Customer</th>
            <th>Package</th>
            <th>Guests</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Update</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @forelse ($bookings as $b)
          <tr>
            <td>{{ $b->booking_ref }}</td>
            <td>{{ $b->customer_name }}<br><span class="text-muted small">{{ $b->customer_email }} / {{ $b->customer_phone }}</span></td>
            <td>{{ $b->package_name }}</td>
            <td>{{ $b->guests }}</td>
            <td>{{ $b->currency }} {{ number_format($b->amount, 2) }}</td>
            <td><span class="badge bg-{{ $b->paymentBadgeClass() }}">{{ $b->payment_status }}</span></td>
            <td><span class="badge bg-{{ $b->statusBadgeClass() }}">{{ $b->booking_status }}</span></td>
            <td>
              <a href="{{ route('admin.bookings.show', $b->id) }}" class="btn btn-sm btn-outline-dark mb-1">View</a>
              <form action="{{ route('admin.bookings.update', $b->id) }}" method="post" class="d-flex gap-1">
                @csrf
                @method('PATCH')
                <select name="booking_status" class="form-select form-select-sm">
                  @foreach (['pending_review','confirmed','cancelled','rejected'] as $status)
                    <option value="{{ $status }}" @selected($b->booking_status === $status)>{{ $status }}</option>
                  @endforeach
                </select>
                <button class="btn btn-sm btn-gold">Save</button>
              </form>
            </td>
            <td>
              <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="post" onsubmit="return confirm('Delete this booking?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="9" class="text-center text-muted py-4">No bookings yet.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
    {{ $bookings->links() }}
  </div>
</section>
@endsection
