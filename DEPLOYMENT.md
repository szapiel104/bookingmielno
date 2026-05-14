# BookingMielno - Wdrozenie na Domena + FTP

Ten dokument jest przygotowany pod hosting wspoldzielony i publikacje przez FTP.

## 1. Cel

Wdrozyc aplikacje pod dzialajaca domene, bez SSH (wariant FTP-first), z baza SQLite w jednym pliku.

## 2. Wymagania hostingu

- PHP 8.2+
- Apache + mod_rewrite
- pdo_sqlite i sqlite3
- Dostep FTP
- Mozliwosc ustawienia uprawnien plikow

## 3. Struktura docelowa na serwerze

Przyklad:

- public_html/bookingmielno

W tym katalogu musza byc wszystkie pliki projektu, w tym:

- app
- bootstrap
- config
- database
- public
- resources
- routes
- storage
- vendor
- artisan
- .env
- .htaccess

## 4. Konfiguracja domeny

Wariant A (zalecany):

- Ustaw DocumentRoot domeny/subdomeny na katalog public aplikacji, np. public_html/bookingmielno/public

Wariant B (gdy nie mozna zmienic DocumentRoot):

- Zostaw domene na public_html
- Uzyj root .htaccess z repo, ktory przekierowuje ruch do katalogu public

## 5. Konfiguracja .env na produkcji

Ustaw wgrany plik .env tak, aby odpowiadal domenie:

APP_NAME=BookingMielno
APP_ENV=production
APP_DEBUG=false
APP_URL=https://twoja-domena.pl

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.provider.pl
MAIL_PORT=587
MAIL_USERNAME=twoj_user
MAIL_PASSWORD=twoje_haslo
MAIL_FROM_ADDRESS=noreply@twoja-domena.pl
MAIL_FROM_NAME="BookingMielno"
NOTIFICATION_EMAIL=admin@twoja-domena.pl

Uwaga:

- W przypadku niektorych hostingow trzeba podac absolutna sciezke do DB_DATABASE.

## 6. Procedura FTP (krok po kroku)

1. Wgraj komplet projektu do katalogu aplikacji.
2. Sprawdz, czy istnieje plik database/database.sqlite.
3. Ustaw uprawnienia:
   - storage: 755 lub 775
   - bootstrap/cache: 755 lub 775
   - database/database.sqlite: 664 lub 644
4. Sprawdz, czy .env ma APP_URL ustawione na produkcyjna domene.
5. Wejdz na strone glowna domeny i wykonaj test otwarcia panelu /admin/login.

## 7. Skad wzielo sie "lokalnie"

"Lokalnie" oznacza tylko etap przygotowania paczki przed uploadem FTP (opcjonalnie):

- php composer.phar install --no-dev --optimize-autoloader
- php artisan migrate --seed --force

Jesli Composer jest dostepny globalnie w PATH, mozna zamiast tego uzyc `composer install --no-dev --optimize-autoloader`.

To nie jest wymog uruchamiania projektu lokalnie po wdrozeniu. Produkcja dziala na domenie i hostingu FTP.

## 8. Testy powdrozeniowe (na domenie)

1. GET /
2. GET /admin/login
3. Wyslanie formularza rezerwacji
4. Potwierdzenie rezerwacji w panelu admin
5. Weryfikacja maili

## 9. Rollback

1. Przywroc poprzedni pakiet plikow przez FTP.
2. Przywroc kopie pliku database/database.sqlite.

## 10. Najczestsze problemy

- 500 po deployu:
  - brak uprawnien do storage/bootstrap/cache/database
- Brak polaczenia z DB:
  - niepoprawna sciezka DB_DATABASE
- Brak maili:
  - bledne SMTP w .env lub panelu

## 11. Checklist dla DevOps

1. Domena wskazuje na poprawny katalog.
2. .env ma APP_ENV=production i APP_DEBUG=false.
3. SQLite istnieje i ma prawa zapisu/odczytu.
4. Panel admina jest dostepny.
5. Formularz booking zapisuje rezerwacje.
6. Wysylka maili dziala.
