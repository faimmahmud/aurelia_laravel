@extends('layouts.master')

@php($pageTitle = 'Confirm Password | Aurelia Travel')

@section('content')
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('{{ e(\App\Support\TravelData::img('confirm-password-visual')) }}')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">Secure area</span>
          <h2 class="display-5 fw-bold mt-3">Confirm your password</h2>
          <p class="mb-0 text-white-50">Just to make sure it's really you.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Confirm</div>
      <h1 class="section-title mb-3">Please confirm</h1>
      <p class="section-lead">This is a secure area. Confirm your password before continuing.</p>

      <form method="post" action="{{ route('password.confirm') }}" class="mt-4 row g-3">
        @csrf
        <div class="col-12">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required autocomplete="current-password">
        </div>
        <div class="col-12">
          <button class="btn btn-gold px-4" type="submit">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
