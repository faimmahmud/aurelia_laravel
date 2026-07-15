<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Display the authenticated customer's personal dashboard:
     * booking stats, spend trend, status breakdown, next upcoming
     * trip, top destinations and full paginated booking history.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $allBookings = Booking::where('customer_email', $user->email)
            ->latest()
            ->get();

        $today = now()->toDateString();

        $stats = [
            'total'     => $allBookings->count(),
            'upcoming'  => $allBookings->whereIn('booking_status', ['confirmed', 'pending_review'])
                ->filter(fn ($b) => $b->travel_date && $b->travel_date >= $today)
                ->count(),
            'confirmed' => $allBookings->where('booking_status', 'confirmed')->count(),
            'spent'     => $allBookings->where('payment_status', 'paid')->sum('amount'),
        ];

        $nextTrip = $allBookings
            ->whereIn('booking_status', ['confirmed', 'pending_review'])
            ->filter(fn ($b) => $b->travel_date && $b->travel_date >= $today)
            ->sortBy('travel_date')
            ->first();

        $daysToNextTrip = null;
        if ($nextTrip && $nextTrip->travel_date) {
            $daysToNextTrip = now()->diffInDays($nextTrip->travel_date, false);
            $daysToNextTrip = $daysToNextTrip < 0 ? 0 : $daysToNextTrip;
        }

        // Status breakdown for the mini bar chart
        $statusBreakdown = $allBookings
            ->groupBy('booking_status')
            ->map->count()
            ->sortDesc();

        $maxStatusCount = $statusBreakdown->max() ?: 1;

        // Spend over the last 6 months (paid bookings only)
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));
        $monthlySpend = $months->map(function ($month) use ($allBookings) {
            $label = $month->format('M');
            $total = $allBookings
                ->where('payment_status', 'paid')
                ->filter(fn ($b) => $b->created_at && $b->created_at->format('Y-m') === $month->format('Y-m'))
                ->sum('amount');

            return ['label' => $label, 'total' => $total];
        });
        $maxMonthlySpend = $monthlySpend->max('total') ?: 1;

        // Most-booked destinations
        $topDestinations = $allBookings
            ->groupBy('destination')
            ->filter(fn ($g, $key) => !empty($key))
            ->map->count()
            ->sortDesc()
            ->take(5);

        // Paginate the full history (real pagination, not just take(10))
        $bookings = Booking::where('customer_email', $user->email)
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('dashboard', compact(
            'stats',
            'nextTrip',
            'daysToNextTrip',
            'statusBreakdown',
            'maxStatusCount',
            'monthlySpend',
            'maxMonthlySpend',
            'topDestinations',
            'bookings'
        ));
    }
}
