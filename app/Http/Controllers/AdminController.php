<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\BookingConfirmed;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $total_bookings = Booking::count();
        $pending_bookings = Booking::where('status', 'Pending')->count();
        $confirmed_bookings = Booking::where('status', 'Confirmed')->count();
        $cancelled_bookings = Booking::where('status', 'Cancelled')->count();

        return view('admin.dashboard', compact(
            'total_bookings',
            'pending_bookings',
            'confirmed_bookings',
            'cancelled_bookings'
        ));
    }

    /**
     * Show bookings list
     */
    public function bookings(Request $request)
    {
        $query = Booking::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', "%$search%")
                  ->orWhere('guest_email', 'like', "%$search%")
                  ->orWhere('guest_phone', 'like', "%$search%");
            });
        }

        $bookings = $query->orderBy('check_in_date', 'desc')->paginate(15);

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Show booking details
     */
    public function showBooking(Booking $booking)
    {
        return view('admin.booking-detail', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function updateBooking(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Confirmed,Cancelled',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $old_status = $booking->status;
        $booking->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $booking->admin_notes,
        ]);

        // Send confirmation email if status changed to Confirmed
        if ($old_status != 'Confirmed' && $validated['status'] == 'Confirmed') {
            $booking->update(['confirmed_at' => now()]);
            try {
                Mail::to($booking->guest_email)->send(new BookingConfirmed($booking));
            } catch (\Exception $e) {
                \Log::error('Failed to send booking confirmation: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.bookings')->with('success', 'Rezerwacja została zaktualizowana.');
    }

    /**
     * Delete booking
     */
    public function deleteBooking(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings')->with('success', 'Rezerwacja została usunięta.');
    }

    /**
     * Show settings page
     */
    public function settings()
    {
        $settings = Setting::all()->keyBy('key');
        
        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        // Handle checkbox that may not be present if unchecked
        if (!$request->has('under_construction')) {
            $request->merge(['under_construction' => false]);
        }

        $validated = $request->validate([
            'price_per_night' => 'required|numeric|min:1',
            'min_nights' => 'required|numeric|min:1',
            'notification_email' => 'required|email',
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|numeric',
            'smtp_username' => 'nullable|string',
            'smtp_password' => 'nullable|string',
            'home_hero_title' => 'nullable|string|max:500',
            'home_hero_subtitle' => 'nullable|string|max:1000',
            'home_about_title' => 'nullable|string|max:500',
            'home_about_text' => 'nullable|string',
            'home_contact_text' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'under_construction' => 'boolean',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        // Update .env file if SMTP settings provided
        if ($validated['smtp_host']) {
            $this->updateEnvFile([
                'MAIL_HOST' => $validated['smtp_host'],
                'MAIL_PORT' => $validated['smtp_port'] ?? 587,
                'MAIL_USERNAME' => $validated['smtp_username'] ?? '',
                'MAIL_PASSWORD' => $validated['smtp_password'] ?? '',
            ]);
        }

        return redirect()->route('admin.settings')->with('success', 'Ustawienia zostały zaktualizowane.');
    }

    /**
     * Update .env file
     */
    private function updateEnvFile($data)
    {
        $env_file = base_path('.env');
        $env_content = file_get_contents($env_file);

        foreach ($data as $key => $value) {
            $pattern = "/^" . preg_quote($key) . "=.*$/m";
            if (preg_match($pattern, $env_content)) {
                $env_content = preg_replace($pattern, "{$key}={$value}", $env_content);
            } else {
                $env_content .= "\n{$key}={$value}";
            }
        }

        file_put_contents($env_file, $env_content);
        
        // Reload the configuration
        \Illuminate\Support\Facades\Artisan::call('config:clear');
    }

    /**
     * Show content editor
     */
    public function contentEditor()
    {
        $settings = Setting::all()->keyBy('key');
        
        return view('admin.content-editor', compact('settings'));
    }

    /**
     * Update content
     */
    public function updateContent(Request $request)
    {
        $validated = $request->validate([
            'home_hero_title' => 'required|string|max:500',
            'home_hero_subtitle' => 'required|string|max:1000',
            'home_about_title' => 'required|string|max:500',
            'home_about_text' => 'required|string',
            'home_contact_text' => 'required|string',
            'footer_text' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.content-editor')->with('success', 'Zawartość została zaktualizowana.');
    }
}
