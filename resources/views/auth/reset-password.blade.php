@extends('layouts.master')

@php($pageTitle = 'Reset Password | Aurelia Travel')

@section('content')
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('{{ e(\App\Support\TravelData::img('reset-password-visual')) }}')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">New password</span>
          <h2 class="display-5 fw-bold mt-3">Choose a new password</h2>
          <p class="mb-0 text-white-50">Make it something you'll remember.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Reset</div>
      <h1 class="section-title mb-3">Set a new password</h1>

      <form method="post" action="{{ route('password.store') }}" class="mt-4 row g-3">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
        </div>
        <div class="col-12">
          <label class="form-label">New password</label>
          <input type="password" name="password" class="form-control" required autocomplete="new-password">
        </div>
        <div class="col-12">
          <label class="form-label">Confirm new password</label>
          <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
        </div>
        <div class="col-12">
          <button class="btn btn-gold px-4" type="submit">Reset password</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
