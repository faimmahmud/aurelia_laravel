@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="section-kicker">Countries</div>
            <h1 class="section-title mb-1">Manage countries</h1>
            <p class="text-muted mb-0">
                All countries used for destinations and tour packages.
            </p>
        </div>

        <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Country
        </a>
    </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th width="70">Flag</th>
                            <th>Country</th>
                            <th>ISO</th>
                            <th>Currency</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($countries as $country)
                            <tr>

                                <td>

                                    @if ($country->flag)
                                        <img src="{{ asset('storage/' . $country->flag) }}" width="40"
                                            class="rounded border">
                                    @else
                                        —
                                    @endif

                                </td>

                                <td>

                                    <strong>{{ $country->name }}</strong>

                                    <br>

                                    <small class="text-muted">
                                        {{ $country->slug }}
                                    </small>

                                </td>

                                <td>

                                    {{ $country->iso2 }}

                                    /

                                    {{ $country->iso3 }}

                                </td>

                                <td>

                                    {{ $country->currency }}

                                </td>

                                <td>

                                    @if ($country->status)
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-warning">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.countries.destroy', $country) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this country?')">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    No countries found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-4">

            {{ $countries->links() }}

        </div>
@endsection
