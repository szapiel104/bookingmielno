# ⚡ QUICKSTART - BookingMielno

Szybki start dla niespodziewanych użytkowników.

## 30 Sekund - Essentials

```
Email: admin@bookingmielno.pl
Hasło: admin123
URL Panelu: /admin
```

**Zmień hasło zaraz po zalogowaniu!**

## 5 Minut - Erste Kroki

1. Zaloguj się do panelu: `/admin`
2. Idź do **Settings**
3. Ustaw:
   - **Price per night** (cena za noc, np. 150 PLN)
   - **SMTP Host** (np. smtp.mailtrap.io)
   - **SMTP Username & Password** (z Mailtrap)
   - **Notification Email** (gdzie mają trafiać rezerwacje, np. admin@bookingmielno.pl)
4. Przejdź do **Content Editor**
5. Edytuj tekst na stronie głównej
6. Kliknij "Zapisz Zmiany"

## 15 Minut - Full Setup

### Konfiguracja SMTP (aby działały e-maile)

1. Zarejestruj się na [Mailtrap.io](https://mailtrap.io)
2. Utwórz nowy Inbox
3. W Settings → skopiuj SMTP credentials
4. Wklej do panelu admina → Settings

### Edycja Zawartości

W **Content Editor** możesz zmienić:
- Tytuł główny
- Podtytuł
- Opis apartamentu
- Nagłówek sekcji kontaktu
- Tekst stopki

Wszystkie zmiany są natychmiast widoczne na stronie!

### Zarządzanie Rezerwacjami

W **Bookings** widzisz wszystkie rezerwacje:
- Kliknij rezerwację aby zobaczyć szczegóły
- Zmień status: Pending → Confirmed (wyślij e-mail klientowi)
- Dodaj notatki administratora

## Struktura Aplikacji

```
📁 public/              ← Pliki publiczne (CSS, JS, obrazki)
📁 resources/views/     ← Szablony HTML (Blade)
  📁 admin/             ← Panel administratora
  📁 layouts/           ← Szablony bazowe
  📁 emails/            ← Szablony e-maili
📁 app/                 ← Logika aplikacji
  📁 Http/Controllers/  ← Kontrollery (logika)
  📁 Models/            ← Modele (Booking, Setting, User)
  📁 Mail/              ← Klasy mailingu
📁 database/
  📁 migrations/        ← Struktura bazy
  📁 seeders/           ← Dane startowe
  database.sqlite       ← Baza danych (SQLite)
```

## API Endpoints (Dla Developerów)

Strona główna komunikuje się z backend poprzez JSON API:

```
GET  /api/availability          → Dostępne daty
POST /api/calculate-price       → Cena za wybrane daty
POST /api/bookings              → Nowa rezerwacja
```

## FAQ

### P: Jak zmienić hasło admina?

A: Aktualnie brak interfejsu. Tymczasowo:
1. Zaloguj się do SSH/Artisan CLI
2. Uruchom: `php artisan tinker`
3. Wpisz: 
```php
\App\Models\User::where('email', 'admin@bookingmielno.pl')->update(['password' => bcrypt('nowe_haslo')]);
```

Lub wdróż funkcję zmiany hasła (zaproponujemy w przyszłej wersji).

### P: E-maile się nie wysyłają

A: Sprawdź:
1. W Settings czy SMTP jest skonfigurowany
2. Czy Notification Email jest prawidłowy
3. Logi: `/storage/logs/laravel.log`
4. Testuj na Mailtrap (darmowy)

### P: Jak dodać więcej administratorów?

A: Dla now:
1. Zaloguj się SSH → `php artisan tinker`
2. Wpisz:
```php
\App\Models\User::create([
    'name' => 'Drugi Admin',
    'email' => 'admin2@example.com',
    'password' => bcrypt('haslo123'),
    'is_admin' => true
]);
```

### P: Jak exportować rezerwacje?

A: Wygeneruj CSV:
1. Zaloguj się do SSH
2. Wpisz: `php artisan tinker`
3. Pobierz dane:
```php
$bookings = \App\Models\Booking::all();
echo $bookings->toJson();
```

### P: Czy mogę zmienić design?

A: Tak! Edytuj:
- `/resources/views/home.blade.php` - strona główna
- `/resources/views/layouts/app.blade.php` - layout + kolory
- CSS w `<style>` sekcji

### P: Jak usunąć rezerwację?

A: W panelu → Bookings → Kliknij rezerwację → Przycisk "Usuń Rezerwację"

### P: Czy jest backup bazy danych?

A: Baza to plik: `/database/database.sqlite`

Backup: Pobierz przez FTP regularnie!

```bash
# Lokalnie (jeśli SSH dostęp)
cp database/database.sqlite database/database.backup.sqlite
```

## Domyślne Ustawienia

| Ustawienie | Wartość |
|-----------|---------|
| Cena za noc | 150 PLN |
| Min. dni | 2 |
| Admin email | admin@bookingmielno.pl |
| Admin hasło | admin123 |
| Baza danych | SQLite |

## Przydatne Linki

- 📖 [Laravel Documentation](https://laravel.com/docs)
- 📅 [FullCalendar Docs](https://fullcalendar.io/docs)
- 📧 [Mailtrap Docs](https://mailtrap.io/doc/)
- 🎨 [Bootstrap 5 Docs](https://getbootstrap.com/docs)
- ⚡ [Alpine.js Docs](https://alpinejs.dev/)

## Ścieżka Dalszego Rozwoju

- [ ] Interfejs zmiany hasła
- [ ] Export rezerwacji do CSV/PDF
- [ ] Integracja z PayPal/Stripe (przedpłata)
- [ ] Walidacja numeru telefonu
- [ ] Dark mode w panelu
- [ ] Więcej opcji w formularz rezerwacji
- [ ] Galeria zdjęć apartamentu
- [ ] Reviews/Opinie gości
- [ ] Multilingual (PL/EN/DE)

---

**Potrzebujesz pomocy?** Przeczytaj `README.md` lub `DEPLOYMENT.md`
