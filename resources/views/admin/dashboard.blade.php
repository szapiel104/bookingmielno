@extends('layouts.admin')

@section('title', 'Dashboard - Panel Administratora')
@section('page_title', 'Dashboard')

@section('content')
<div class="row mb-2 mb-md-3">
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="metric-card">
            <p class="metric-label">Razem rezerwacji</p>
            <p class="metric-value">{{ $total_bookings }}</p>
            <a href="{{ route('admin.bookings') }}" class="metric-link">Przejdź <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="metric-card is-pending">
            <p class="metric-label">Oczekujące</p>
            <p class="metric-value">{{ $pending_bookings }}</p>
            <a href="{{ route('admin.bookings', ['status' => 'Pending']) }}" class="metric-link">Filtruj <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="metric-card is-confirmed">
            <p class="metric-label">Potwierdzone</p>
            <p class="metric-value">{{ $confirmed_bookings }}</p>
            <a href="{{ route('admin.bookings', ['status' => 'Confirmed']) }}" class="metric-link">Filtruj <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="metric-card is-cancelled">
            <p class="metric-label">Anulowane</p>
            <p class="metric-value">{{ $cancelled_bookings }}</p>
            <a href="{{ route('admin.bookings', ['status' => 'Cancelled']) }}" class="metric-link">Filtruj <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
</div>

<div class="row mt-1 mt-md-2">
    <div class="col-lg-8">
        <div class="card admin-panel">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line mr-2"></i>Podsumowanie systemu</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="text-muted mb-2">Do weryfikacji</p>
                        <h2 class="mb-0">{{ $pending_bookings }}</h2>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-2">Współczynnik potwierdzeń</p>
                        <h2 class="mb-0">{{ round($confirmed_bookings / max(1, $total_bookings) * 100) }}%</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card admin-panel">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bolt mr-2"></i>Szybkie akcje</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.bookings') }}" class="btn btn-primary btn-block mb-2">Zarządzaj rezerwacjami</a>
                <a href="{{ route('admin.content-editor') }}" class="btn btn-outline-secondary btn-block mb-2">Edytor treści</a>
                <a href="{{ route('admin.settings') }}" class="btn btn-outline-info btn-block">Ustawienia systemu</a>
            </div>
        </div>
    </div>
</div>

@endsection
