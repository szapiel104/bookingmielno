@extends('layouts.admin')

@section('title', 'Dashboard - Panel Administratora')
@section('page_title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $total_bookings }}</h3>
                <p>Razem rezerwacji</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="{{ route('admin.bookings') }}" class="small-box-footer">
                Przejdź <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pending_bookings }}</h3>
                <p>Oczekujące</p>
            </div>
            <div class="icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <a href="{{ route('admin.bookings', ['status' => 'Pending']) }}" class="small-box-footer">
                Filtruj <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $confirmed_bookings }}</h3>
                <p>Potwierdzone</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('admin.bookings', ['status' => 'Confirmed']) }}" class="small-box-footer">
                Filtruj <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $cancelled_bookings }}</h3>
                <p>Anulowane</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <a href="{{ route('admin.bookings', ['status' => 'Cancelled']) }}" class="small-box-footer">
                Filtruj <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
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
