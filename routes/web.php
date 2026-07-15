<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/destinations', [FrontendController::class, 'destinations'])->name('destinations');
Route::get('/packages', [FrontendController::class, 'packages'])->name('packages');
Route::get('/world', [FrontendController::class, 'world'])->name('world');

/*
|--------------------------------------------------------------------------
| Booking
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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

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
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Countries
        |--------------------------------------------------------------------------
        */

        Route::resource('countries', CountryController::class);

        /*
        |--------------------------------------------------------------------------
        | Destinations
        |--------------------------------------------------------------------------
        */

        Route::resource('destinations', DestinationController::class);

        /*
        |--------------------------------------------------------------------------
        | Bookings
        |--------------------------------------------------------------------------
        */

        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
        Route::get('/bookings/{id}', [AdminController::class, 'bookingShow'])->name('bookings.show');
        Route::patch('/bookings/{id}', [AdminController::class, 'updateStatus'])->name('bookings.update');
        Route::delete('/bookings/{id}', [AdminController::class, 'destroyBooking'])->name('bookings.destroy');

        /*
        |--------------------------------------------------------------------------
        | Packages
        |--------------------------------------------------------------------------
        */

        Route::get('/packages', [AdminController::class, 'packages'])->name('packages');
        Route::get('/packages/create', [AdminController::class, 'packagesCreate'])->name('packages.create');
        Route::post('/packages', [AdminController::class, 'packagesStore'])->name('packages.store');
        Route::get('/packages/{id}/edit', [AdminController::class, 'packagesEdit'])->name('packages.edit');
        Route::put('/packages/{id}', [AdminController::class, 'packagesUpdate'])->name('packages.update');
        Route::delete('/packages/{id}', [AdminController::class, 'packagesDestroy'])->name('packages.destroy');

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.role');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        /*
        |--------------------------------------------------------------------------
        | Branding Settings
        |--------------------------------------------------------------------------
        */

        Route::get('/settings/branding', [AdminController::class, 'branding'])->name('settings.branding');
        Route::post('/settings/branding', [AdminController::class, 'brandingUpdate'])->name('settings.branding.update');

        /*
        |--------------------------------------------------------------------------
        | Contact Settings
        |--------------------------------------------------------------------------
        */

        Route::get('/settings/contact', [AdminController::class, 'contact'])->name('settings.contact');
        Route::post('/settings/contact', [AdminController::class, 'contactUpdate'])->name('settings.contact.update');
    });

require __DIR__ . '/auth.php';
