<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingAuditLog;
use App\Models\Package;
use App\Models\PackageFeature;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('booking_status', 'pending_review')->count(),
            'confirmed' => Booking::where('booking_status', 'confirmed')->count(),
            'revenue' => Booking::where('payment_status', 'paid')->sum('amount'),
        ];

        $bookings = Booking::latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'bookings'));
    }

    public function bookings()
    {
        $bookings = Booking::latest()->paginate(15);

        return view('admin.bookings', compact('bookings'));
    }

    public function bookingShow(string $id)
    {
        $booking = Booking::with(['notifications', 'auditLogs'])->findOrFail($id);

        return view('admin.booking-view', compact('booking'));
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'booking_status' => 'required|string|max:40',
        ]);

        $booking = Booking::findOrFail($id);
        $old = $booking->booking_status;
        $booking->booking_status = $request->booking_status;
        $booking->save();

        BookingAuditLog::create([
            'booking_id' => $booking->id,
            'actor_email' => $request->user()->email,
            'actor_role' => $request->user()->role,
            'action_type' => 'status_update',
            'old_status' => $old,
            'new_status' => $booking->booking_status,
        ]);

        return redirect()->back()->with('success', 'Booking status updated.');
    }

    public function destroyBooking(string $id)
    {
        Booking::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

    public function packages()
    {
        $packages = Package::with('features')->latest()->get();

        return view('admin.packages', compact('packages'));
    }

    public function packagesCreate()
    {
        return view('admin.package-form', ['package' => null]);
    }

    public function packagesStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:190',
            'country' => 'nullable|string|max:120',
            'price' => 'required|string|max:50',
            'rating' => 'nullable|string|max:20',
            'days' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:60',
            'details' => 'nullable|string',
            'image' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|max:5120',
        ]);

        $image = $validated['image'] ?? '';
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('packages', 'public');
            $image = '/storage/' . $path;
        }

        if ($image === '') {
            return redirect()->back()->withInput()->with('error', 'Title and image are required.');
        }

        $package = Package::create([
            'id' => 'pkg_' . Str::random(12),
            'title' => $validated['title'],
            'country' => $validated['country'] ?? '',
            'price' => $validated['price'],
            'rating' => $validated['rating'] ?? '5.0',
            'days' => $validated['days'] ?? '',
            'image' => $image,
            'description' => $validated['description'] ?? '',
            'category' => $validated['category'] ?? 'city',
        ]);

        $this->syncFeatures($package, $validated['details'] ?? '');

        return redirect()->route('admin.packages')->with('success', 'Package added successfully.');
    }

    public function packagesEdit(string $id)
    {
        $package = Package::with('features')->findOrFail($id);

        return view('admin.package-form', compact('package'));
    }

    public function packagesUpdate(Request $request, string $id)
    {
        $package = Package::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:190',
            'country' => 'nullable|string|max:120',
            'price' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:20',
            'days' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:60',
            'details' => 'nullable|string',
            'image' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|max:5120',
        ]);

        $image = $validated['image'] ?? $package->image;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('packages', 'public');
            $image = '/storage/' . $path;
        }

        $package->update([
            'title' => $validated['title'],
            'country' => $validated['country'] ?? $package->country,
            'price' => $validated['price'] ?? $package->price,
            'rating' => $validated['rating'] ?? $package->rating,
            'days' => $validated['days'] ?? $package->days,
            'description' => $validated['description'] ?? $package->description,
            'category' => $validated['category'] ?? $package->category,
            'image' => $image,
        ]);

        $this->syncFeatures($package, $validated['details'] ?? '');

        return redirect()->route('admin.packages')->with('success', 'Package updated.');
    }

    public function packagesDestroy(string $id)
    {
        Package::findOrFail($id)->delete();

        return redirect()->route('admin.packages')->with('success', 'Package deleted.');
    }

    // ==========================================
    // Branding Settings
    // ==========================================
    public function branding()
    {
        return view('admin.settings.branding');
    }

    public function brandingUpdate(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:150',
            'company_tagline' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:4096',
            'dark_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:4096',
            'favicon' => 'nullable|image|mimes:png,ico,svg|max:2048',
        ]);

        Setting::set('branding.company_name', $validated['company_name']);
        Setting::set('branding.company_tagline', $validated['company_tagline'] ?? '');

        $uploads = [
            'logo' => 'branding.logo',
            'dark_logo' => 'branding.dark_logo',
            'favicon' => 'branding.favicon',
        ];

        foreach ($uploads as $field => $settingKey) {
            if ($request->hasFile($field)) {
                $old = Setting::get($settingKey);
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                $path = $request->file($field)->store('branding', 'public');
                Setting::set($settingKey, $path);
            }
        }

        return redirect()->back()->with('success', 'Branding settings updated successfully.');
    }

    // ==========================================
    // Contact Settings
    // ==========================================
    public function contact()
    {
        return view('admin.settings.contact');
    }

    public function contactUpdate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:150',
            'google_map' => 'nullable|url|max:500',
        ]);

        Setting::set('contact.email', $validated['email'] ?? '');
        Setting::set('contact.phone', $validated['phone'] ?? '');
        Setting::set('contact.whatsapp', $validated['whatsapp'] ?? '');
        Setting::set('contact.address', $validated['address'] ?? '');
        Setting::set('contact.working_hours', $validated['working_hours'] ?? '');
        Setting::set('contact.google_map', $validated['google_map'] ?? '');

        return redirect()->back()->with('success', 'Contact settings updated successfully.');
    }

    // ==========================================
    // Helper Methods
    // ==========================================
    private function syncFeatures(Package $package, string $detailsText): void
    {
        $package->features()->delete();

        $lines = array_values(array_filter(array_map('trim', explode("\n", trim($detailsText)))));

        foreach ($lines as $i => $feature) {
            PackageFeature::create([
                'package_id' => $package->id,
                'feature' => $feature,
                'sort_order' => $i,
            ]);
        }
    }
}
