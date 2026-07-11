@extends('layouts.admin')

@section('title', 'Branding Settings')

@section('content')

    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="fw-bold mb-1">Branding Settings</h2>
                <p class="text-muted">
                    Manage your company branding information.
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.settings.branding.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Company Branding
                    </h5>
                </div>

                <div class="card-body">

                    <div class="mb-4">
                        <label class="form-label">
                            Company Name
                        </label>

                        <input type="text" name="company_name" class="form-control"
                            value="{{ old('company_name', \App\Models\Setting::get('branding.company_name')) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Company Tagline
                        </label>

                        <input type="text" name="company_tagline" class="form-control"
                            value="{{ old('company_tagline', \App\Models\Setting::get('branding.company_tagline')) }}">
                    </div>

                    <hr>

                    <h5 class="mb-4">
                        Company Logo
                    </h5>

                    <div class="mb-4">

                        <label class="form-label">
                            Logo
                        </label>

                        @if (\App\Models\Setting::get('branding.logo'))
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . \App\Models\Setting::get('branding.logo')) }}"
                                    style="height:70px" class="img-thumbnail">
                            </div>
                        @endif

                        <input type="file" name="logo" class="form-control">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Dark Logo
                        </label>

                        @if (\App\Models\Setting::get('branding.dark_logo'))
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . \App\Models\Setting::get('branding.dark_logo')) }}"
                                    style="height:70px" class="img-thumbnail">
                            </div>
                        @endif

                        <input type="file" name="dark_logo" class="form-control">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Favicon
                        </label>

                        @if (\App\Models\Setting::get('branding.favicon'))
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . \App\Models\Setting::get('branding.favicon')) }}"
                                    style="height:40px" class="img-thumbnail">
                            </div>
                        @endif

                        <input type="file" name="favicon" class="form-control">

                    </div>

                </div>

                <div class="card-footer bg-white">

                    <button type="submit" class="btn btn-primary">
                        Save Branding
                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection
