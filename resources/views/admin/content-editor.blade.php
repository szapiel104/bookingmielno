@extends('layouts.admin')

@section('title', 'Edytor Treści - Panel Administratora')
@section('page_title', 'Edytor treści')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Zmiany treści strony głównej i sekcji informacyjnych.</p>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-1"></i>Dashboard</a>
</div>

<div class="card admin-panel">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-pen mr-2"></i>Edytuj zawartość strony</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.content.update') }}" method="POST">
            @csrf

            <div class="mb-4">
                <h6 class="border-bottom pb-2">Sekcja Hero (nagłówek)</h6>
                
                <div class="mb-3">
                    <label class="form-label">Tytuł Główny</label>
                    <input type="text" name="home_hero_title" class="form-control" 
                           value="{{ $settings['home_hero_title']->value ?? '' }}" required>
                    <small class="text-muted">Główny nagłówek wyświetlany na stronie głównej</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Podtytuł</label>
                    <input type="text" name="home_hero_subtitle" class="form-control" 
                           value="{{ $settings['home_hero_subtitle']->value ?? '' }}" required>
                    <small class="text-muted">Krótki opis pod głównym nagłówkiem</small>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="border-bottom pb-2">Sekcja O nas</h6>
                
                <div class="mb-3">
                    <label class="form-label">Tytuł Sekcji</label>
                    <input type="text" name="home_about_title" class="form-control" 
                           value="{{ $settings['home_about_title']->value ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Zawartość Tekstu</label>
                    <textarea name="home_about_text" class="form-control" rows="6" required>{{ $settings['home_about_text']->value ?? '' }}</textarea>
                    <small class="text-muted">Opis apartamentu i jego walorów. Możesz użyć enter do przełamań wierszy.</small>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="border-bottom pb-2">Sekcja kontaktu</h6>
                
                <div class="mb-3">
                    <label class="form-label">Nagłówek Sekcji Kontaktu</label>
                    <input type="text" name="home_contact_text" class="form-control" 
                           value="{{ $settings['home_contact_text']->value ?? '' }}" required>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="border-bottom pb-2">Stopka</h6>
                
                <div class="mb-3">
                    <label class="form-label">Tekst Stopki</label>
                    <input type="text" name="footer_text" class="form-control" 
                           value="{{ $settings['footer_text']->value ?? '' }}" required>
                    <small class="text-muted">Tekst wyświetlany na dole każdej strony</small>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Zapisz zmiany</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Anuluj</a>
            </div>
        </form>
    </div>
</div>

<div class="card admin-panel mt-4">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-eye mr-2"></i>Podgląd zmian</h3>
    </div>
    <div class="card-body">
        <p class="text-muted mb-0">Aby zobaczyć zmiany na stronie, odwiedź <a href="/" target="_blank">stronę główną <i class="fas fa-external-link-alt"></i></a></p>
    </div>
</div>

@endsection
