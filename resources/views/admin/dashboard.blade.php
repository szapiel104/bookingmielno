@extends('layouts.admin')

@section('title', 'Dashboard - Panel Administratora')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card">
            <h5>Razem Rezerwacji</h5>
            <div class="number">{{ $total_bookings }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card">
            <h5>Oczekujące</h5>
            <div class="number" style="color: #ea580c;">{{ $pending_bookings }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card">
            <h5>Potwierdzone</h5>
            <div class="number" style="color: #16a34a;">{{ $confirmed_bookings }}</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card">
            <h5>Anulowane</h5>
            <div class="number" style="color: #dc2626;">{{ $cancelled_bookings }}</div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">📊 Statystyka Rezerwacji</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Szybki przegląd bieżącego statusu systemu rezerwacji.</p>
                <div style="text-align: center;">
                    <p class="mb-0">Liczba rezerwacji do weryfikacji: <strong>{{ $pending_bookings }}</strong></p>
                    <p>Współczynnik potwierdzeń: <strong>{{ round($confirmed_bookings / max(1, $total_bookings) * 100) }}%</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">⚡ Szybkie Linki</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-outline-primary mb-2 w-100">Zarządzaj Rezerwacjami</a>
                <a href="{{ route('admin.content-editor') }}" class="btn btn-sm btn-outline-secondary mb-2 w-100">Edytuj Zawartość</a>
                <a href="{{ route('admin.settings') }}" class="btn btn-sm btn-outline-info w-100">Ustawienia Systemu</a>
            </div>
        </div>
    </div>
</div>

@endsection
