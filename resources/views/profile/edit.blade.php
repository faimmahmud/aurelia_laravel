@extends('layouts.master')

@php($pageTitle = 'My Profile | Aurelia Travel')

@section('content')
<section class="arc-section arc-top">
  <div class="container" style="max-width:720px;">
    <div class="section-kicker">Account</div>
    <h1 class="section-title mb-4">Profile settings</h1>

    <div class="form-shell p-4 p-lg-5 reveal mb-4">
      <h2 class="h5 mb-1">Profile information</h2>
      <p class="text-muted small mb-4">Update your account's name and email address.</p>

      <form method="post" action="{{ route('profile.update') }}" class="row g-3">
        @csrf
        @method('patch')
        <div class="col-12">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
          @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

          @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 small">
              Your email address is unverified.
              <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                @csrf
                <button class="btn btn-link btn-sm p-0 align-baseline">Click here to re-send the verification email.</button>
              </form>
              @if (session('status') === 'verification-link-sent')
                <div class="text-success mt-1">A new verification link has been sent to your email address.</div>
              @endif
            </div>
          @endif
        </div>
        <div class="col-12 d-flex align-items-center gap-3">
          <button class="btn btn-gold px-4" type="submit">Save</button>
          @if (session('status') === 'profile-updated')
            <span class="text-success small">Saved.</span>
          @endif
        </div>
      </form>
    </div>

    <div class="form-shell p-4 p-lg-5 reveal mb-4">
      <h2 class="h5 mb-1">Update password</h2>
      <p class="text-muted small mb-4">Ensure your account is using a long, random password to stay secure.</p>

      <form method="post" action="{{ route('password.update') }}" class="row g-3">
        @csrf
        @method('put')
        <div class="col-12">
          <label class="form-label">Current password</label>
          <input type="password" name="current_password" class="form-control" autocomplete="current-password">
          @error('current_password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
          <label class="form-label">New password</label>
          <input type="password" name="password" class="form-control" autocomplete="new-password">
          @error('password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
          <label class="form-label">Confirm password</label>
          <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
          @error('password_confirmation', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="col-12 d-flex align-items-center gap-3">
          <button class="btn btn-gold px-4" type="submit">Save</button>
          @if (session('status') === 'password-updated')
            <span class="text-success small">Saved.</span>
          @endif
        </div>
      </form>
    </div>

    <div class="form-shell p-4 p-lg-5 reveal border border-danger-subtle">
      <h2 class="h5 mb-1 text-danger">Delete account</h2>
      <p class="text-muted small mb-4">
        Once your account is deleted, all of its resources and data will be permanently deleted.
        Please enter your password to confirm.
      </p>

      <form method="post" action="{{ route('profile.destroy') }}" class="row g-3" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
        @csrf
        @method('delete')
        <div class="col-12 col-md-6">
          <input type="password" name="password" class="form-control" placeholder="Password">
          @error('password', 'userDeletion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
          <button class="btn btn-outline-danger px-4" type="submit">Delete account</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
