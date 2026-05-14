<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\NewBookingNotification;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Get available dates (dates without confirmed bookings)
     */
    public function getAvailability()
    {
        $bookings = Booking::where('status', 'Confirmed')->get(['check_in_date', 'check_out_date']);
        
        $booked_dates = [];
        foreach ($bookings as $booking) {
            $current_date = $booking->check_in_date->copy();
            while ($current_date < $booking->check_out_date) {
                $booked_dates[] = $current_date->format('Y-m-d');
                $current_date->addDay();
            }
        }

        return response()->json([
            'booked_dates' => $booked_dates,
        ]);
    }

    /**
     * Calculate price for selected dates
     */
    public function calculatePrice(Request $request)
    {
        $validated = $request->validate([
            'check_in' => 'required|date_format:Y-m-d',
            'check_out' => 'required|date_format:Y-m-d|after:check_in',
        ]);

        $check_in = Carbon::createFromFormat('Y-m-d', $validated['check_in'])->startOfDay();
        $check_out = Carbon::createFromFormat('Y-m-d', $validated['check_out'])->startOfDay();

        $nights = $check_in->diffInDays($check_out);
        $min_nights = (int) Setting::get('min_nights', 1);

        if ($nights < $min_nights) {
            return response()->json([
                'message' => "Minimalna liczba nocy to {$min_nights}.",
            ], 422);
        }

        $price_per_night = Setting::get('price_per_night', 100);
        $total_price = $nights * $price_per_night;

        return response()->json([
            'nights' => $nights,
            'min_nights' => $min_nights,
            'price_per_night' => $price_per_night,
            'total_price' => $total_price,
        ]);
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email',
            'guest_phone' => 'required|string|max:20',
            'check_in_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'check_out_date' => 'required|date_format:Y-m-d|after:check_in_date',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Check for overlapping bookings
        $overlapping = Booking::whereIn('status', ['Pending', 'Confirmed'])
            ->where('check_in_date', '<', $validated['check_out_date'])
            ->where('check_out_date', '>', $validated['check_in_date'])
            ->exists();

        if ($overlapping) {
            return response()->json(['message' => 'Wybrane daty są już zarezerwowane.'], 422);
        }

        $check_in = Carbon::createFromFormat('Y-m-d', $validated['check_in_date'])->startOfDay();
        $check_out = Carbon::createFromFormat('Y-m-d', $validated['check_out_date'])->startOfDay();
        $nights = $check_in->diffInDays($check_out);
        $min_nights = (int) Setting::get('min_nights', 1);

        if ($nights < $min_nights) {
            return response()->json([
                'message' => "Minimalna liczba nocy to {$min_nights}.",
            ], 422);
        }
        
        $price_per_night = Setting::get('price_per_night', 100);
        $total_price = $nights * $price_per_night;

        $booking = Booking::create([
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'guest_phone' => $validated['guest_phone'],
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'number_of_nights' => $nights,
            'price_per_night' => $price_per_night,
            'total_price' => $total_price,
            'special_requests' => $validated['special_requests'] ?? null,
            'status' => 'Pending',
        ]);

        // Send notification emails
        $notification_email = Setting::get('notification_email', env('MAIL_FROM_ADDRESS'));
        
        try {
            Mail::to($notification_email)->send(new NewBookingNotification($booking));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin notification: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Rezerwacja została przyjęta. Czekamy na potwierdzenie.',
            'booking_id' => $booking->id,
        ]);
    }
}
