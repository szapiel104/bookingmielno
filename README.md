# BookingMielno

System rezerwacji apartamentu z panelem administratora (Laravel 12 + Blade + Vite).

## Wymagania

- PHP 8.2+
- Node.js 20+
- SQLite (domyslnie) lub inna baza wspierana przez Laravel

## Szybki start

1. Sklonuj repozytorium.
2. Skopiuj konfiguracje:

```bash
cp .env.example .env
```

3. Zainstaluj zaleznosci PHP:

```bash
php composer.phar install
```

4. Wygeneruj klucz aplikacji:

```bash
php artisan key:generate
```

5. Przygotuj baze i dane:

```bash
php artisan migrate --seed
```

6. Zainstaluj zaleznosci frontendowe:

```bash
yarn install
```

7. Uruchom aplikacje lokalnie:

```bash
php artisan serve
yarn dev
```

Panel admina: `/admin`

## Build produkcyjny

```bash
yarn build
```

## Testy

```bash
php artisan test
```

## Najwazniejsze obszary projektu

- `app/Http/Controllers` - logika aplikacji i panelu admina
- `resources/views/admin` - widoki panelu administratora
- `resources/views/layouts/admin.blade.php` - glowny layout panelu
- `routes/web.php` - trasy publiczne i administracyjne

## Dokumentacja dodatkowa

- `QUICKSTART.md` - szybka instrukcja obslugi panelu
- `DEPLOYMENT.md` - wdrozenie produkcyjne
- `DEPLOYMENT_SEOHOST_FTP.md` - wdrozenie przez FTP

