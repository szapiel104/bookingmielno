<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@bookingmielno.pl'],
            [
                'name' => 'Administrator',
                'email' => 'admin@bookingmielno.pl',
                'password' => bcrypt('BookingMielno@2026!Admin'),
                'is_admin' => true,
            ]
        );

        // Create default settings
        $settings = [
            'home_hero_title' => 'Witamy w BookingMielno',
            'home_hero_subtitle' => 'Luksusowy apartament w sercu Mielna',
            'home_about_title' => 'O naszym apartamencie',
            'home_about_text' => 'Nasz apartament oferuje wyjątkowe doświadczenie w pięknym otoczeniu. Dysponujemy nowoczesnym wyposażeniem i wygodnymi pomieszczeniami, idealnymi dla rodzin i par szukających spokojnego wypoczynku.',
            'home_contact_text' => 'Skontaktuj się z nami',
            'footer_text' => '© 2024 BookingMielno. Wszystkie prawa zastrzeżone.',
            'price_per_night' => 150,
            'min_nights' => 2,
            'notification_email' => 'admin@bookingmielno.pl',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 587,
            'smtp_username' => '',
            'smtp_password' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::create([
                'key' => $key,
                'value' => $value,
                'type' => is_numeric($value) ? 'number' : 'text',
            ]);
        }
    }
}

