@extends('layouts.master')

@php($pageTitle = 'Verify Email | Aurelia Travel')

@section('content')
<section class="arc-section arc-top">
  <div class="container" style="max-width:640px;">
    <div class="form-shell p-4 p-lg-5 reveal">
      <div class="section-kicker">Account</div>
      <h1 class="section-title mb-3">Verify your email</h1>
      <p class="section-lead">
        Thanks for signing up! Before getting started, could you verify your email address by clicking the link
        we just emailed you? If you didn't receive it, we'll gladly send another.
      </p>

      @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success rounded-4 mt-3">
          A new verification link has been sent to the email address you provided during registration.
        </div>
      @endif

      <div class="mt-4 d-flex flex-wrap justify-content-between gap-2 align-items-center">
        <form method="post" action="{{ route('verification.send') }}">
          @csrf
          <button type="submit" class="btn btn-gold px-4">Resend verification email</button>
        </form>
        <form method="post" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-dark px-4">Log out</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
