@extends('layouts.master')

@php($pageTitle = 'Page Not Found | Aurelia Travel')

@section('content')
<section class="arc-section arc-top text-center">
  <div class="container" style="max-width:560px;">
    <span class="hero-kicker">404</span>
    <h1 class="section-title mt-3">This page has wandered off</h1>
    <p class="section-lead">The page you're looking for doesn't exist or has moved.</p>
    <a href="{{ route('home') }}" class="btn btn-gold px-4 mt-3">Back to home</a>
  </div>
</section>
@endsection
