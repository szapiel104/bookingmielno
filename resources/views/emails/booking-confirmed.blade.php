<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
        .details { background: white; padding: 15px; margin: 10px 0; border-left: 4px solid #16a34a; }
        .footer { text-align: center; padding: 10px; color: #999; font-size: 12px; }
        strong { color: #1a1a2e; }
        .success-badge { display: inline-block; background: #16a34a; color: white; padding: 5px 10px; border-radius: 3px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>✅ Rezerwacja Potwierdzona!</h2>
        </div>
        <div class="content">
            <p>Drogi/a {{ $booking->guest_name }},</p>
            
            <p>Mamy przyjemność poinformować Cię, że Twoja rezerwacja została potwierdzona!</p>

            <div class="details">
                <span class="success-badge">REZERWACJA POTWIERDZONA</span><br>
                <strong>Numer rezerwacji:</strong> #{{ $booking->id }}<br>
                <strong>Gość:</strong> {{ $booking->guest_name }}<br>
                <strong>Telefon kontaktowy:</strong> {{ $booking->guest_phone }}
            </div>

            <div class="details">
                <strong>📅 Daty Pobytu:</strong><br>
                Przyjazd: <strong>{{ $booking->check_in_date->format('d.m.Y (l)') }}</strong><br>
                Wyjazd: <strong>{{ $booking->check_out_date->format('d.m.Y (l)') }}</strong><br>
                Liczba nocy: {{ $booking->number_of_nights }}
            </div>

            <div class="details">
                <strong>💰 Podsumowanie Ceny:</strong><br>
                Cena za noc: {{ $booking->price_per_night }} PLN<br>
                Liczba nocy: {{ $booking->number_of_nights }}<br>
                <strong style="font-size: 1.3em; color: #16a34a;">Razem do zapłaty: {{ $booking->total_price }} PLN</strong>
            </div>

            <div class="details">
                <strong>📍 Informacje Praktyczne:</strong><br>
                Godzina Check-in: 15:00<br>
                Godzina Check-out: 11:00<br>
                Adres: Mielno, Polska<br>
                <br>
                <em>Szczegóły dotyczące dostępu i instrukcji zostały wysłane na adres e-mail lub będą dostępne przed Twoim przyjazdem.</em>
            </div>

            <p style="margin-top: 20px; background: #e8f5e9; padding: 15px; border-radius: 5px;">
                <strong>Dziękujemy za zaufanie!</strong><br>
                Jeśli masz jakiekolwiek pytania, skontaktuj się z nami pod numerem {{ \App\Models\Setting::get('phone', '+48 123 456 789') }} lub wyślij e-mail na adres: {{ \App\Models\Setting::get('notification_email', 'admin@Mielno.pl') }}
            </p>

            <p style="text-align: center; margin-top: 30px; color: #666;">
                Cieszę się na Twoją wizytę w Mielno! 🏖️
            </p>
        </div>
        <div class="footer">
            <p>© 2024 Mielno - System Rezerwacji</p>
        </div>
    </div>
</body>
</html>
