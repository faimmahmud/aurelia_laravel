@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="section-kicker">Destinations</div>
            <h1 class="section-title mb-1">Manage destinations</h1>
            <p class="text-muted mb-0">Curated destinations shown across the site.</p>
        </div>

        <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Destination
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="70">Image</th>
                        <th>Destination</th>
                        <th>Country</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($destinations as $d)
                    <tr>
                        <td>
                            @if ($d->thumbnail)
                                <img src="{{ asset('storage/'.$d->thumbnail) }}" width="48" class="rounded border">
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <strong>{{ $d->name }}</strong><br>
                            <small class="text-muted">{{ $d->slug }}</small>
                        </td>
                        <td>{{ $d->country }}</td>
                        <td>
                            @if ($d->featured)
                                <span class="badge bg-warning text-dark">Featured</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if ($d->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.destinations.edit', $d) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.destinations.destroy', $d) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this destination?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-5">No destinations found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $destinations->links() }}
    </div>
@endsection
