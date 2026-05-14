# BookingMielno - Wdrozenie na SEOHOST (hosting wspoldzielony + FTP)

Ten dokument opisuje wdrozenie aplikacji BookingMielno na SEOHOST bez SSH, w trybie FTP-first.

## 1. Wymagania

- Aktywna usluga hostingu wspoldzielonego SEOHOST
- Podpieta domena do konta
- Dostep do panelu klienta SEOHOST
- Dostep FTP (host, login, haslo, port)
- PHP 8.2+ wlaczone dla domeny
- Wlaczone rozszerzenia sqlite3 i pdo_sqlite

## 2. Przygotowanie paczki do uploadu

Na komputerze lokalnym przygotuj komplet plikow projektu:

1. php composer.phar install --no-dev --optimize-autoloader
2. Upewnij sie, ze istnieje plik database/database.sqlite
3. Upewnij sie, ze jest plik .env z konfiguracja produkcyjna

Jesli masz Composer dodany globalnie do PATH, mozesz uzyc rownowaznego polecenia:

- composer install --no-dev --optimize-autoloader

Wgrywasz caly projekt, w tym:

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

## 3. Ustawienie domeny w SEOHOST

W panelu SEOHOST:

1. Dodaj/wybierz domene docelowa.
2. Ustaw wersje PHP na 8.2 lub wyzsza.
3. Ustaw katalog domeny na folder aplikacji, np. public_html/bookingmielno.

Wariant preferowany:

- Jesli panel pozwala, ustaw DocumentRoot bezposrednio na public_html/bookingmielno/public.

Wariant alternatywny:

- Gdy nie mozna ustawic DocumentRoot na public, zostaw root domeny na public_html/bookingmielno i uzyj root .htaccess z projektu (przekierowanie do /public).

## 4. Upload przez FTP

1. Polacz sie FTP (np. FileZilla).
2. Wejdz do katalogu domeny, np. public_html/bookingmielno.
3. Wgraj wszystkie pliki projektu.
4. Potwierdz, ze istnieje:
   - database/database.sqlite
   - public/index.php
   - .env
   - .htaccess

## 5. Konfiguracja .env na produkcji

W pliku .env ustaw:

APP_NAME=BookingMielno
APP_ENV=production
APP_DEBUG=false
APP_URL=https://twoja-domena.pl

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.twoj-provider.pl
MAIL_PORT=587
MAIL_USERNAME=twoj_user
MAIL_PASSWORD=twoje_haslo
MAIL_FROM_ADDRESS=noreply@twoja-domena.pl
MAIL_FROM_NAME="BookingMielno"
NOTIFICATION_EMAIL=admin@twoja-domena.pl

Uwaga:

- Jezeli SEOHOST wymaga sciezki absolutnej do SQLite, ustaw DB_DATABASE jako pelna sciezke serwerowa.

## 6. Uprawnienia plikow i katalogow

Ustaw przez FTP/panel:

- storage -> 755 lub 775
- bootstrap/cache -> 755 lub 775
- database -> 755
- database/database.sqlite -> 664 lub 644

Jesli pojawi sie blad 500 po deployu, najpierw sprawdz te uprawnienia.

## 7. Pierwsze uruchomienie po wdrozeniu

1. Wejdz na https://twoja-domena.pl
2. Wejdz na https://twoja-domena.pl/admin/login
3. Zaloguj sie kontem admina
4. W panelu ustaw SMTP i email powiadomien
5. Wykonaj testowa rezerwacje na stronie glownej

## 8. Dane logowania admin (domyslne)

- email: admin@bookingmielno.pl
- haslo: admin123

Po pierwszym logowaniu zmien haslo admina.

## 9. Checklista odbiorowa (SEOHOST)

1. Domena otwiera strone glowna bez bledu 500.
2. /admin/login dziala.
3. Formularz rezerwacji zapisuje rekord.
4. Status rezerwacji da sie zmienic w panelu.
5. Maile wychodza przez skonfigurowane SMTP.

## 10. Najczestsze problemy na hostingu wspoldzielonym

Brak tabel / no such table:

- Wgrano zly plik database.sqlite albo pusty plik.

500 Internal Server Error:

- Zle uprawnienia storage/bootstrap/cache/database.
- Bledne APP_KEY lub bledny .env.

Brak wysylki email:

- Zle dane SMTP.
- Blokada portu SMTP przez provider (zmien port lub provider).

Routing nie dziala:

- Sprawdz czy .htaccess jest w katalogu root aplikacji.
- Jezeli mozliwe, ustaw DocumentRoot domeny bezposrednio na /public.
