# Aurelia Travel — Laravel 12 Edition

This is the plain-PHP "Aurelia Travel" tourism site converted into a Laravel 12
project, using the same architecture/file-structure pattern as your Urban
Tourism (`urban1`) project: Breeze auth scaffolding, `role` middleware
(admin/user), a `FrontendController` for public pages, and Blade views under
`resources/views/home`.

Design, copy, and static data (destinations, packages, countries, testimonials)
are unchanged from the original site — only the plumbing moved to Laravel.

## What changed vs the original PHP site

- `includes/functions.php`'s custom router/session helpers -> Laravel routing,
  auth (Breeze), and sessions.
- `includes/travel-data.php` -> `app/Support/TravelData.php` (same arrays).
- `index.php / destinations.php / packages.php / world.php` -> Blade views in
  `resources/views/home/*.blade.php`, served by `FrontendController`.
- `booking.php` + `includes/booking-submit.php` -> `BookingController` +
  `resources/views/booking/create.blade.php`, persisting to the `bookings`
  table (Eloquent) instead of JSON files.
- `admin/*` -> `AdminController` + `resources/views/admin/*` (dashboard +
  bookings list with status update / delete). This is a streamlined rebuild
  of the admin panel, not a line-for-line port of all 8 original admin
  scripts (package CRUD screens were not carried over in this pass).
- `database/schema.sql` -> Laravel migrations (`packages`, `package_features`,
  `bookings`, `payment_transactions`, `booking_notifications`,
  `booking_audit_logs`), same columns.
- Login/Register pages currently use Laravel Breeze's default views (not yet
  restyled to match the black/gold Aurelia look).

## Setup (Hostinger / local)

    composer install
    cp .env.example .env
    php artisan key:generate
    # set DB_DATABASE/DB_USERNAME/DB_PASSWORD in .env (mysql, tourism_FM)
    php artisan migrate
    php artisan storage:link

Static assets (CSS/JS/images) are already in `public/assets` — no Vite build
required, same as the original CDN-based Bootstrap setup.

Create an admin user via tinker or a seeder, then set their `role` column to
`admin` to access `/admin/dashboard`.
