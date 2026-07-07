@extends('layouts.master')

@php($pageTitle = 'Login | Aurelia Travel')

@section('content')
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('{{ e(\App\Support\TravelData::img('login-visual')) }}')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">Secure access</span>
          <h2 class="display-5 fw-bold mt-3">Enter the concierge space</h2>
          <p class="mb-0 text-white-50">Luxury bookings, admin tools, and premium content management.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Login</div>
      <h1 class="section-title mb-3">Welcome back</h1>
      <p class="section-lead">Use your registered account to continue.</p>

      <x-auth-session-status class="mb-3" :status="session('status')" />

      <form method="post" action="{{ route('login') }}" class="mt-4 row g-3">
        @csrf
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="col-12">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="d-flex align-items-center gap-2">
            <input type="checkbox" name="remember"> <span class="small text-muted">Remember me</span>
          </label>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 align-items-center">
          <button class="btn btn-gold px-4" type="submit">Login</button>
          <a href="{{ route('register') }}" class="btn btn-outline-dark px-4">Create account</a>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="small text-muted ms-2">Forgot password?</a>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
