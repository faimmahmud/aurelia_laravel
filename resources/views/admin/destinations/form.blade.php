@extends('layouts.admin')

@section('content')
<div class="section-kicker">Destinations</div>
<h1 class="section-title mb-4">{{ $destination ? 'Edit destination' : 'Add destination' }}</h1>

<div class="card p-4">
  <form action="{{ $destination ? route('admin.destinations.update', $destination) : route('admin.destinations.store') }}"
        method="POST">
    @csrf
    @if ($destination) @method('PUT') @endif

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Destination name *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $destination->name ?? '') }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Country *</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $destination->country ?? '') }}" required>
      </div>

      <div class="col-md-12">
        <label class="form-label">Thumbnail image URL / path</label>
        <input type="text" name="thumbnail" class="form-control" value="{{ old('thumbnail', $destination->thumbnail ?? '') }}" placeholder="destinations/example.jpg">
        @if (!empty($destination->thumbnail))
          <img src="{{ asset('storage/'.$destination->thumbnail) }}" class="mt-2 rounded border" width="100">
        @endif
      </div>

      <div class="col-12">
        <label class="form-label">Short description</label>
        <input type="text" name="short_description" class="form-control" value="{{ old('short_description', $destination->short_description ?? '') }}">
      </div>

      <div class="col-12">
        <label class="form-label">Full description</label>
        <textarea name="description" rows="5" class="form-control">{{ old('description', $destination->description ?? '') }}</textarea>
      </div>

      <div class="col-md-6 form-check ps-4">
        <input type="checkbox" name="featured" id="featured" class="form-check-input"
          {{ old('featured', $destination->featured ?? false) ? 'checked' : '' }}>
        <label for="featured" class="form-check-label">Featured</label>
      </div>
      <div class="col-md-6 form-check ps-4">
        <input type="checkbox" name="status" id="status" class="form-check-input"
          {{ old('status', $destination->status ?? true) ? 'checked' : '' }}>
        <label for="status" class="form-check-label">Active (visible on site)</label>
      </div>
    </div>

    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn btn-primary px-4">{{ $destination ? 'Update destination' : 'Save destination' }}</button>
      <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-dark px-4">Cancel</a>
    </div>
  </form>
</div>
@endsection
