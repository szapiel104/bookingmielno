# 📍 BookingMielno - System Rezerwacji Apartamentów

Profesjonalny system rezerwacji apartamentów "Single Property" zbudowany w **Laravel 11** z bazą danych **SQLite**. System pełni rolę CMS-a, gdzie wszystkie treści strony są edytowalne z panelu admina.

## 🎯 Funkcjonalności

### Strona Główna (CMS)
- ✅ Dynamiczny nagłówek (hero section) - edytowalny z panelu
- ✅ Sekcja "O nas" - pełna zawartość edytowalna
- ✅ Kalendarz dostępności z FullCalendar.js
- ✅ Formularz rezerwacji z walidacją i obliczaniem ceny
- ✅ Responsywny design (100% mobile-friendly)
- ✅ Nowoczesny design (modern luxury)

### Panel Administratora
- ✅ **Zarządzanie Rezerwacjami**: lista rezerwacji, zmiana statusów (Pending/Confirmed/Cancelled)
- ✅ **Edytor Treści**: zmiana tekstów na stronie głównej
- ✅ **Ustawienia Systemowe**: 
  - Cena za noc
  - Minimalna liczba dni
  - E-mail do powiadomień
  - Konfiguracja SMTP
  - Bezpośrednia edycja w bazie danych

### System Powiadomień
- ✅ Mail do Admina po nowym zgłoszeniu
- ✅ Mail do Klienta po potwierdzeniu rezerwacji
- ✅ Obsługa błędów mailowania

### Technologia
- **Backend**: Laravel 11 (PHP)
- **Baza danych**: SQLite (plik `database/database.sqlite`)
- **Frontend**: Blade Templates + Bootstrap 5.3 + Alpine.js
- **Biblioteki**: FullCalendar.js, Flatpickr, SweetAlert2
- **Hosting**: Kompatybilny z hostingiem współdzielonym (FTP)

## 📦 Wymagania

- PHP 8.2+
- Composer
- Hosting z obsługą PHP
- Możliwość użycia Artisan CLI (ewentualnie wymagane na hości)

## 🚀 Instalacja - Krok po Kroku

### 1. Przygotowanie na Lokalnym Komputerze

```bash
# Klonuj/Pobierz projekt
cd bookingmielno

# Zainstaluj zależności PHP
php composer.phar install

# Alternatywnie, jeśli Composer jest dostępny globalnie w PATH:
# composer install

# Skopiuj plik .env
cp .env.example .env

# Wygeneruj klucz aplikacji
php artisan key:generate

# Utwórz plik bazy danych
touch database/database.sqlite

# Uruchom migracje i seedery
php artisan migrate --seed

# (Opcjonalnie) Uruchom serwer lokalnie do testów
php artisan serve
```

### 2. Konfiguracja .env (Przed wdrożeniem)

Edytuj plik `.env` w głównym folderze projektu:

```env
APP_NAME="BookingMielno"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://twoja-domena.pl

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=twoja_nazwa_uzytkownika
MAIL_PASSWORD=twoje_haslo
MAIL_FROM_ADDRESS="noreply@bookingmielno.pl"
NOTIFICATION_EMAIL=admin@bookingmielno.pl
```

### 3. Wdrożenie na Hosting (FTP)

1. **Zaloguj się na FTP** do swojego hostingu
2. **Wgraj wszystko** do folderu, np. `/public_html/booking/`
3. **Ustaw uprawnienia**:
   - `/storage/` → 755 (do zapisu)
   - `/bootstrap/cache/` → 755 (do zapisu)
   - `/database/database.sqlite` → 644 (czytanie/zapis dla serwera)

4. **Skonfiguruj domenę**: Ustaw root folder na `/public/` (jeśli dostępne w panelu)

### 4. Dostęp do Panelu Administratora

Po wdrożeniu przejdź na: `https://twoja-domena.pl/admin`

**Dane logowania domyślne:**
- E-mail: `admin@bookingmielno.pl`
- Hasło: `admin123`

⚠️ **ZMIEŃ HASŁO NATYCHMIAST!**

### 5. Konfiguracja Wstępna

Po zalogowaniu:
1. Settings → Zmień hasło
2. Settings → Skonfiguruj SMTP
3. Settings → Ustaw cenę za noc
4. Content Editor → Edytuj teksty strony
5. Testuj rezerwację na stronie głównej

## 📧 Konfiguracja E-maili

Rekomendujemy **Mailtrap.io** (darmowy dla testów):

1. Zarejestruj się na [Mailtrap.io](https://mailtrap.io)
2. Utwórz Inbox
3. Skopiuj dane SMTP
4. Wklej do Settings panelu

```env
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=xxxxx
MAIL_PASSWORD=xxxxx
```

## 🔒 Bezpieczeństwo

- ✅ CSRF protection
- ✅ SQL Injection protection (Eloquent ORM)
- ✅ Input validation
- ✅ Password hashing (bcrypt)

Po wdrożeniu wykonaj:
```bash
php artisan config:cache
php artisan route:cache
```

## 📱 Responsywność

- ✅ Mobile First
- ✅ Bootstrap 5.3 Grid
- ✅ Alpine.js bez przeładowania strony
- ✅ Testowane: iPhone, Android, Tablets, Desktop

## 🛠️ Troubleshooting

### Błąd: "no such table"
```bash
php artisan migrate
```

### E-maile się nie wysyłają
- Sprawdź logi: `/storage/logs/laravel.log`
- Sprawdź konfigurację SMTP w Settings
- Testuj na Mailtrap

### Wyczyść cache
```bash
php artisan config:clear
php artisan cache:clear
```

## 📊 Struktura Bazy Danych

```
bookings - rezerwacje (imię, email, telefon, daty, cena, status)
settings - ustawienia (klucz-wartość)
users    - użytkownicy (z polem is_admin)
```

## 🎨 Personalizacja

Edytuj zawartość z panelu! Nie musisz modyfikować kodu.

---

**Wersja**: 1.0.0  
**Framework**: Laravel 11  
**Database**: SQLite

