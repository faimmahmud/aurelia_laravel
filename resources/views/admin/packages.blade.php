@extends('layouts.master')

@php($pageTitle = 'Manage Packages | Aurelia Travel')

@section('content')
<section class="arc-section arc-top">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <div class="section-kicker">Admin</div>
        <h1 class="section-title mb-0">Tour packages</h1>
      </div>
      <a href="{{ route('admin.packages.create') }}" class="btn btn-gold px-4">Add package</a>
    </div>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Country</th>
            <th>Price</th>
            <th>Category</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @forelse ($packages as $pkg)
          <tr>
            <td><div style="width:70px;height:50px;background-size:cover;background-position:center;border-radius:8px;background-image:url('{{ $pkg->image }}')"></div></td>
            <td>{{ $pkg->title }}</td>
            <td>{{ $pkg->country }}</td>
            <td>{{ $pkg->price }}</td>
            <td>{{ $pkg->category }}</td>
            <td class="text-end">
              <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="btn btn-sm btn-outline-dark">Edit</a>
              <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this package?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted py-4">No packages saved yet — the public Packages page still shows the built-in catalog.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection
