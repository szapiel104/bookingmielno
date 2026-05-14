<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%); color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
        .details { background: white; padding: 15px; margin: 10px 0; border-left: 4px solid #0f3460; }
        .footer { text-align: center; padding: 10px; color: #999; font-size: 12px; }
        strong { color: #1a1a2e; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📍 Nowa Rezerwacja - BookingMielno</h2>
        </div>
        <div class="content">
            <p>Otrzymałeś nową rezerwację!</p>
            
            <div class="details">
                <strong>Dane Gościa:</strong><br>
                Imię: {{ $booking->guest_name }}<br>
                E-mail: {{ $booking->guest_email }}<br>
                Telefon: {{ $booking->guest_phone }}
            </div>

            <div class="details">
                <strong>Daty Pobytu:</strong><br>
                Przyjazd: {{ $booking->check_in_date->format('d.m.Y') }}<br>
                Wyjazd: {{ $booking->check_out_date->format('d.m.Y') }}<br>
                Liczba nocy: {{ $booking->number_of_nights }}
            </div>

            <div class="details">
                <strong>Cena:</strong><br>
                Cena za noc: {{ $booking->price_per_night }} PLN<br>
                Razem: <strong style="font-size: 1.2em;">{{ $booking->total_price }} PLN</strong>
            </div>

            @if($booking->special_requests)
            <div class="details">
                <strong>Specjalne Życzenia:</strong><br>
                {{ $booking->special_requests }}
            </div>
            @endif

            <p style="margin-top: 20px; text-align: center;">
                <a href="{{ route('admin.bookings') }}" style="background: #0f3460; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    Przejdź do Panelu Admina
                </a>
            </p>
        </div>
        <div class="footer">
            <p>© 2024 BookingMielno - System Rezerwacji</p>
        </div>
    </div>
</body>
</html>
