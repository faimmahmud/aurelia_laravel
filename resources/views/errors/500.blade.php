@extends('layouts.master')

@php($pageTitle = 'Server Error | Aurelia Travel')

@section('content')
<section class="arc-section arc-top text-center">
  <div class="container" style="max-width:560px;">
    <span class="hero-kicker">500</span>
    <h1 class="section-title mt-3">Something went wrong</h1>
    <p class="section-lead">Please try again in a moment.</p>
    <a href="{{ route('home') }}" class="btn btn-gold px-4 mt-3">Back to home</a>
  </div>
</section>
@endsection
