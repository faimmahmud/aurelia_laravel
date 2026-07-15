@extends('layouts.admin')

@php($pageTitle = ($package ? 'Edit Package' : 'Add Package') . ' | Aurelia Travel')

@section('content')
<section class="arc-section mt-0">
  <div class="container">
    <div class="form-shell p-4 p-lg-5 reveal">
      <div class="section-kicker">Admin</div>
      <h1 class="section-title mb-3">{{ $package ? 'Edit tour package' : 'Add tour package' }}</h1>

      <form method="post" action="{{ $package ? route('admin.packages.update', $package->id) : route('admin.packages.store') }}" enctype="multipart/form-data" class="row g-3">
        @csrf
        @if ($package)
          @method('PUT')
        @endif

        <div class="col-md-6"><input class="form-control" name="title" placeholder="Title" value="{{ old('title', $package->title ?? '') }}" required></div>
        <div class="col-md-6"><input class="form-control" name="country" placeholder="Country" value="{{ old('country', $package->country ?? '') }}"></div>
        <div class="col-md-4"><input class="form-control" name="price" placeholder="Price" value="{{ old('price', $package->price ?? '') }}" required></div>
        <div class="col-md-4"><input class="form-control" name="rating" placeholder="Rating" value="{{ old('rating', $package->rating ?? '5.0') }}"></div>
        <div class="col-md-4"><input class="form-control" name="days" placeholder="Days" value="{{ old('days', $package->days ?? '7 Days') }}"></div>
        <div class="col-12"><textarea class="form-control" name="description" rows="4" placeholder="Description">{{ old('description', $package->description ?? '') }}</textarea></div>

        <div class="col-md-6">
          <label class="form-label">Image URL</label>
          <input class="form-control" name="image" placeholder="https://..." value="{{ old('image', $package->image ?? '') }}">
        </div>
        <div class="col-md-6">
          <label class="form-label">Or upload image</label>
          <input class="form-control" type="file" name="image_file" accept="image/*">
        </div>

        <div class="col-md-6"><input class="form-control" name="category" placeholder="Category" value="{{ old('category', $package->category ?? 'city') }}"></div>
        <div class="col-12">
          <label class="form-label">Features (one per line)</label>
          <textarea class="form-control" name="details" rows="4" placeholder="One feature per line">{{ old('details', $package && $package->relationLoaded('features') ? $package->features->pluck('feature')->implode("\n") : '') }}</textarea>
        </div>

        <div class="col-12">
          <button class="btn btn-gold px-4" type="submit">{{ $package ? 'Update package' : 'Save package' }}</button>
          <a class="btn btn-outline-dark px-4" href="{{ route('admin.packages') }}">Back</a>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
