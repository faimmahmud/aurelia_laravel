@extends('layouts.master')

@php($pageTitle = 'Access Denied | Aurelia Travel')

@section('content')
<section class="arc-section arc-top text-center">
  <div class="container" style="max-width:560px;">
    <span class="hero-kicker">403</span>
    <h1 class="section-title mt-3">Access denied</h1>
    <p class="section-lead">{{ $exception->getMessage() ?: "You don't have permission to view this page." }}</p>
    <a href="{{ route('home') }}" class="btn btn-gold px-4 mt-3">Back to home</a>
  </div>
</section>
@endsection
