@extends('layouts.master')

@php($pageTitle = 'Forgot Password | Aurelia Travel')

@section('content')
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('{{ e(\App\Support\TravelData::img('forgot-password-visual')) }}')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">Account recovery</span>
          <h2 class="display-5 fw-bold mt-3">Forgot your password?</h2>
          <p class="mb-0 text-white-50">We'll email you a link to choose a new one.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Reset password</div>
      <h1 class="section-title mb-3">No problem</h1>
      <p class="section-lead">Enter your email address and we'll send you a password reset link.</p>

      <x-auth-session-status class="mb-3" :status="session('status')" />

      <form method="post" action="{{ route('password.email') }}" class="mt-4 row g-3">
        @csrf
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="col-12">
          <button class="btn btn-gold px-4" type="submit">Email password reset link</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
