@extends('layouts.admin')

@section('title', 'Ustawienia - Panel Administratora')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Ustawienia Systemu</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">← Dashboard</a>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">💰 Ustawienia Cen</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Cena za Noc (PLN)</label>
                        <input type="number" name="price_per_night" class="form-control" step="0.01" min="1"
                               value="{{ $settings['price_per_night']->value ?? 100 }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Minimalna Liczba Dni</label>
                        <input type="number" name="min_nights" class="form-control" min="1"
                               value="{{ $settings['min_nights']->value ?? 1 }}" required>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">📧 Powiadomienia Email</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">E-mail do Powiadomień</label>
                        <input type="email" name="notification_email" class="form-control" 
                               value="{{ $settings['notification_email']->value ?? '' }}" required>
                        <small class="text-muted">Na ten adres będą wysyłane powiadomienia o nowych rezerwacjach</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">📬 Konfiguracja SMTP</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <strong>Ważne:</strong> Skonfiguruj serwer SMTP aby system mógł wysyłać e-maile. 
                        Polecamy usługi takie jak <strong>Mailtrap.io</strong> lub <strong>SendGrid</strong>.
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Host SMTP</label>
                        <input type="text" name="smtp_host" class="form-control" 
                               value="{{ $settings['smtp_host']->value ?? 'smtp.mailtrap.io' }}"
                               placeholder="np. smtp.mailtrap.io">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Port SMTP</label>
                        <input type="number" name="smtp_port" class="form-control" 
                               value="{{ $settings['smtp_port']->value ?? 587 }}"
                               placeholder="587">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nazwa Użytkownika</label>
                        <input type="text" name="smtp_username" class="form-control" 
                               value="{{ $settings['smtp_username']->value ?? '' }}"
                               placeholder="Twoja nazwa użytkownika">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hasło</label>
                        <input type="password" name="smtp_password" class="form-control" 
                               value="{{ $settings['smtp_password']->value ?? '' }}"
                               placeholder="Twoje hasło SMTP">
                        <small class="text-muted">Hasło nie będzie wyświetlane po załadowaniu strony</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">🔧 Dodatkowe Ustawienia</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="under_construction" 
                           id="under_construction" 
                           value="1"
                           @if(isset($settings['under_construction']) && $settings['under_construction']->value) checked @endif>
                    <label class="form-check-label" for="under_construction">
                        <strong>🔨 Tryb "W Budowie"</strong>
                        <br>
                        <small class="text-muted">Włącz ten tryb, aby pokazać niezalogowanym użytkownikom komunikat o stronie w budowie</small>
                    </label>
                </div>
            </div>
            <hr>
            <p class="text-muted mb-0">Inne ustawienia można zmienić edytując zawartość strony w sekcji <strong>Edytor Treści</strong>.</p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">💾 Zapisz Ustawienia</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Anuluj</a>
    </div>
</form>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">ℹ️ Informacje o Systemie</h5>
    </div>
    <div class="card-body">
        <p><strong>Wersja Laravel:</strong> {{ app()->version() }}</p>
        <p><strong>PHP:</strong> {{ phpversion() }}</p>
        <p><strong>Baza Danych:</strong> SQLite</p>
    </div>
</div>

@endsection
