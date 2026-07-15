@extends('layouts.admin')

@section('content')
<div class="section-kicker">Countries</div>
<h1 class="section-title mb-4">Edit country</h1>

<div class="card p-4">
  <form action="{{ route('admin.countries.update', $country) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.countries._form')
    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn btn-primary px-4">Update country</button>
      <a href="{{ route('admin.countries.index') }}" class="btn btn-outline-dark px-4">Cancel</a>
    </div>
  </form>
</div>
@endsection
