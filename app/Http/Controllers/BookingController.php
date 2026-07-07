<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingAuditLog;
use App\Models\BookingNotification;
use App\Models\Package;
use App\Support\TravelData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $data = TravelData::all();

        $selectedPackageId = trim((string) $request->query('package_id', ''));
        $selectedPackageName = trim((string) $request->query('package_name', $request->query('package', '')));
        $selectedCountry = trim((string) $request->query('country', ''));
        $selectedAmount = trim((string) $request->query('amount', ''));
        $selectedType = trim((string) $request->query('booking_type', 'ticket'));

        if ($selectedPackageId !== '' && $selectedPackageName === '') {
            foreach ($data['packages'] as $pkg) {
                if (($pkg['id'] ?? '') === $selectedPackageId) {
                    $selectedPackageName = $pkg['title'] ?? '';
                    $selectedCountry = $pkg['country'] ?? $selectedCountry;
                    $selectedAmount = preg_replace('/[^0-9.]/', '', (string) ($pkg['price'] ?? ''));
                    break;
                }
            }
        }

        $selectedAmount = $selectedAmount !== '' ? $selectedAmount : '0';
        $displayPackageName = $selectedPackageName !== '' ? $selectedPackageName : 'General ticket booking';

        $user = $request->user();

        return view('booking.create', array_merge($data, [
            'selectedPackageId' => $selectedPackageId,
            'selectedCountry' => $selectedCountry,
            'selectedAmount' => $selectedAmount,
            'selectedType' => $selectedType,
            'displayPackageName' => $displayPackageName,
            'userName' => $user->name ?? '',
            'userEmail' => $user->email ?? '',
        ]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_type' => 'nullable|string|max:30',
            'package_id' => 'nullable|string|max:64',
            'package_name' => 'required|string|max:190',
            'country' => 'nullable|string|max:120',
            'departure_from' => 'nullable|string|max:120',
            'destination' => 'nullable|string|max:120',
            'travel_date' => 'required|date',
            'travel_time' => 'required',
            'leave_date' => 'required|date',
            'leave_time' => 'required',
            'guests' => 'nullable|integer|min:1',
            'customer_name' => 'required|string|max:150',
            'customer_email' => 'required|email|max:190',
            'customer_phone' => 'required|string|max:60',
            'payment_method' => 'nullable|string|max:40',
            'payment_reference' => 'nullable|string|max:190',
            'amount' => 'nullable',
            'currency' => 'nullable|string|max:3',
            'message' => 'nullable|string',
        ]);

        $paymentMethods = ['cash', 'bkash', 'nagad', 'rocket', 'card', 'bank', 'paypal'];
        $paymentMethod = strtolower($validated['payment_method'] ?? 'cash');
        if (!in_array($paymentMethod, $paymentMethods, true)) {
            $paymentMethod = 'cash';
        }

        $paymentStatusMap = [
            'cash' => 'unpaid',
            'bank' => 'unpaid',
            'bkash' => 'pending_verification',
            'nagad' => 'pending_verification',
            'rocket' => 'pending_verification',
            'card' => 'pending_verification',
            'paypal' => 'pending_verification',
        ];

        $amount = (float) preg_replace('/[^0-9.]/', '', (string) ($validated['amount'] ?? 0));
        if ($amount <= 0 && !empty($validated['package_id'])) {
            $package = Package::find($validated['package_id']);
            if ($package) {
                $amount = (float) preg_replace('/[^0-9.]/', '', (string) $package->price);
            }
        }

        $user = $request->user();

        $booking = Booking::create([
            'id' => (string) Str::uuid(),
            'booking_ref' => 'AT-' . strtoupper(Str::random(8)),
            'booking_type' => $validated['booking_type'] ?? 'package',
            'package_id' => $validated['package_id'] ?? null,
            'package_name' => $validated['package_name'],
            'country' => $validated['country'] ?? '',
            'departure_from' => $validated['departure_from'] ?? '',
            'destination' => $validated['destination'] ?? '',
            'travel_date' => $validated['travel_date'],
            'travel_time' => $validated['travel_time'],
            'leave_date' => $validated['leave_date'],
            'leave_time' => $validated['leave_time'],
            'guests' => max(1, (int) ($validated['guests'] ?? 1)),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'payment_method' => $paymentMethod,
            'payment_reference' => $validated['payment_reference'] ?? '',
            'payment_status' => $paymentStatusMap[$paymentMethod] ?? 'unpaid',
            'booking_status' => 'pending_review',
            'approval_status' => 'pending',
            'amount' => $amount,
            'currency' => strtoupper($validated['currency'] ?? 'USD'),
            'message' => $validated['message'] ?? null,
            'booked_by' => $user->email ?? 'guest',
            'booked_role' => $user->role ?? 'guest',
            'booking_channel' => 'website',
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        BookingNotification::create([
            'booking_id' => $booking->id,
            'audience' => 'admin',
            'channel' => 'in_app',
            'action_type' => 'booking_created',
            'title' => 'New booking received',
            'body' => $booking->customer_name . ' booked ' . $booking->package_name,
            'status' => 'unread',
        ]);

        BookingAuditLog::create([
            'booking_id' => $booking->id,
            'actor_email' => $user->email ?? 'guest',
            'actor_role' => $user->role ?? 'guest',
            'action_type' => 'created',
            'old_status' => '',
            'new_status' => 'pending_review',
        ]);

        return redirect()->route('booking.create')
            ->with('success', 'Booking submitted successfully. Reference: ' . $booking->booking_ref);
    }
}
