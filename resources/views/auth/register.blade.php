@extends('layouts.master')

@php($pageTitle = 'Register | Aurelia Travel')

@section('content')
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('{{ e(\App\Support\TravelData::img('register-visual')) }}')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">New account</span>
          <h2 class="display-5 fw-bold mt-3">Start your luxury journey</h2>
          <p class="mb-0 text-white-50">Register to save bookings and access premium travel experiences.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Register</div>
      <h1 class="section-title mb-3">Create account</h1>

      <form method="post" action="{{ route('register') }}" class="mt-4 row g-3">
        @csrf
        <div class="col-12">
          <label class="form-label">Full name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="col-12">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Confirm password</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 align-items-center">
          <button class="btn btn-gold px-4" type="submit">Register</button>
          <a href="{{ route('login') }}" class="btn btn-outline-dark px-4">Login</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
