<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / Frontend Routes (Aurelia Travel)
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/destinations', [FrontendController::class, 'destinations'])->name('destinations');
Route::get('/packages', [FrontendController::class, 'packages'])->name('packages');
Route::get('/world', [FrontendController::class, 'world'])->name('world');

/*
|--------------------------------------------------------------------------
| Booking (auth required, same as original login-gated booking.php)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/admin/bookings/{id}', [AdminController::class, 'bookingShow'])->name('admin.bookings.show');
    Route::patch('/admin/bookings/{id}', [AdminController::class, 'updateStatus'])->name('admin.bookings.update');
    Route::delete('/admin/bookings/{id}', [AdminController::class, 'destroyBooking'])->name('admin.bookings.destroy');

    Route::get('/admin/packages', [AdminController::class, 'packages'])->name('admin.packages');
    Route::get('/admin/packages/create', [AdminController::class, 'packagesCreate'])->name('admin.packages.create');
    Route::post('/admin/packages', [AdminController::class, 'packagesStore'])->name('admin.packages.store');
    Route::get('/admin/packages/{id}/edit', [AdminController::class, 'packagesEdit'])->name('admin.packages.edit');
    Route::put('/admin/packages/{id}', [AdminController::class, 'packagesUpdate'])->name('admin.packages.update');
    Route::delete('/admin/packages/{id}', [AdminController::class, 'packagesDestroy'])->name('admin.packages.destroy');
    Route::get('/admin/settings/branding', [AdminController::class, 'branding'])
        ->name('admin.settings.branding');
        Route::get('/admin/settings/branding', [AdminController::class, 'branding'])
    ->name('admin.settings.branding');
    Route::post('/admin/settings/branding', [AdminController::class, 'brandingUpdate'])
    ->name('admin.settings.branding.update');
});

require __DIR__ . '/auth.php';
