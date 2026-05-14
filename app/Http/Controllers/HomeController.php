<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Booking;

class HomeController extends Controller
{
    /**
     * Show the application homepage
     */
    public function index()
    {
        // Check if site is under construction and user is not logged in
        $under_construction = Setting::get('under_construction', false);
        if ($under_construction && !auth()->check()) {
            return view('under-construction');
        }

        $hero_title = Setting::get('home_hero_title', 'Witamy w BookingMielno');
        $hero_subtitle = Setting::get('home_hero_subtitle', 'Luksusowy apartament w sercu Mielna');
        $about_title = Setting::get('home_about_title', 'O naszym apartamencie');
        $about_text = Setting::get('home_about_text', 'Przygotuj się na wyjątkowe doświadczenie...');
        $contact_text = Setting::get('home_contact_text', 'Skontaktuj się z nami');
        $price_per_night = Setting::get('price_per_night', 100);
        $min_nights = Setting::get('min_nights', 1);

        return view('home', compact(
            'hero_title',
            'hero_subtitle',
            'about_title',
            'about_text',
            'contact_text',
            'price_per_night',
            'min_nights'
        ));
    }

    /**
     * Show the contact page
     */
    public function contact()
    {
        return view('contact');
    }
}
