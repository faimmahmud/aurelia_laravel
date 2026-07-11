@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Header Area -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Contact Settings</h1>
                <p class="text-muted mb-0">Manage your agency's public contact information and support channels.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>

        <!-- Alert Notifications -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> Please fix the errors below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Main Configuration Form -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book me-2"></i>Contact
                            Information</h6>
                        <span class="badge bg-light text-dark">Global Settings</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.contact.update') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label font-weight-bold">Primary Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email', \App\Models\Setting::get('contact.email')) }}"
                                            placeholder="info@aureliatravel.com">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label font-weight-bold">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-phone text-muted"></i></span>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone"
                                            value="{{ old('phone', \App\Models\Setting::get('contact.phone')) }}"
                                            placeholder="+880 1234-567890">
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- WhatsApp Number -->
                                <div class="col-md-6">
                                    <label for="whatsapp" class="form-label font-weight-bold">WhatsApp Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fab fa-whatsapp text-success"></i></span>
                                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                            id="whatsapp" name="whatsapp"
                                            value="{{ old('whatsapp', \App\Models\Setting::get('contact.whatsapp')) }}"
                                            placeholder="+880 1234-567890">
                                    </div>
                                    @error('whatsapp')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Working Hours -->
                                <div class="col-md-6">
                                    <label for="working_hours" class="form-label font-weight-bold">Working Hours</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-clock text-muted"></i></span>
                                        <input type="text"
                                            class="form-control @error('working_hours') is-invalid @enderror"
                                            id="working_hours" name="working_hours"
                                            value="{{ old('working_hours', \App\Models\Setting::get('contact.working_hours')) }}"
                                            placeholder="Sat - Thu: 9:00 AM - 6:00 PM">
                                    </div>
                                    @error('working_hours')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Physical Address -->
                                <div class="col-12">
                                    <label for="address" class="form-label font-weight-bold">Office Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-map-marked-alt text-muted"></i></span>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2"
                                            placeholder="123 Luxury Tower, Level 4, Gulshan, Dhaka, Bangladesh">{{ old('address', \App\Models\Setting::get('contact.address')) }}</textarea>
                                    </div>
                                    @error('address')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Google Map Embed URL -->
                                <div class="col-12">
                                    <label for="google_map" class="form-label font-weight-bold">Google Map Embed/Share
                                        URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-map-pin text-danger"></i></span>
                                        <input type="url"
                                            class="form-control @error('google_map') is-invalid @enderror" id="google_map"
                                            name="google_map"
                                            value="{{ old('google_map', \App\Models\Setting::get('contact.google_map')) }}"
                                            placeholder="https://maps.google.com/...">
                                    </div>
                                    <div class="form-text text-muted small">Paste the standard Google Maps share URL or
                                        embed link here.</div>
                                    @error('google_map')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4 text-muted">

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-2"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar / Information Panel -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4 bg-gradient-primary text-white border-0">
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold"><i class="fas fa-lightbulb me-2 text-warning"></i> Quick Tips</h5>
                        <p class="small mb-3 mt-2" style="opacity: 0.9;">
                            These contact options dynamically reflect on your website's footer, contact page, and booking
                            confirmation communications.
                        </p>
                        <ul class="list-unstyled small mb-0 ps-0" style="opacity: 0.85;">
                            <li class="mb-2"><i class="fas fa-check me-2 text-success-light"></i> Standardize phone
                                numbers with international codes.</li>
                            <li class="mb-2"><i class="fas fa-check me-2 text-success-light"></i> The WhatsApp number
                                handles instant visitor inquiries.</li>
                            <li><i class="fas fa-check me-2 text-success-light"></i> Make sure the email address is
                                actively monitored for client requests.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
