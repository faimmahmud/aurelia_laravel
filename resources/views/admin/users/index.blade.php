@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <div class="section-kicker">People</div>
            <h1 class="section-title mb-1">Manage users</h1>
            <p class="text-muted mb-0">All registered accounts and their access level.</p>
        </div>

        <form method="GET" class="d-flex gap-2">
            <input type="text" name="q" class="form-control" placeholder="Search name or email..." value="{{ request('q') }}">
            <button class="btn btn-outline-dark">Search</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Bookings</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->booking_count }}</td>
                        <td>
                            <span class="badge {{ $u->role === 'admin' ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td>{{ $u->created_at->format('d M Y') }}</td>
                        <td class="d-flex gap-2">
                            <form action="{{ route('admin.users.role', $u) }}" method="POST" class="d-flex gap-1">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-select form-select-sm" style="width:110px;">
                                    <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button class="btn btn-sm btn-primary">Save</button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $u) }}" method="POST"
                                  onsubmit="return confirm('Delete this user permanently?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-5">No users found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
