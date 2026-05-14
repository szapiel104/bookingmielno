@extends('layouts.admin')

@section('title', 'Rezerwacje - Panel Administratora')
@section('page_title', 'Rezerwacje')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <p class="text-muted mb-2 mb-md-0">Zarządzaj zgłoszeniami i aktualizuj statusy rezerwacji.</p>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i>Dashboard
    </a>
</div>

<div class="card admin-panel mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-5 mb-2 mb-md-0">
                <input type="text" name="search" class="form-control" placeholder="Szukaj gościa..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3 mb-2 mb-md-0">
                <select name="status" class="form-control">
                    <option value="">Wszystkie statusy</option>
                    <option value="Pending" @if(request('status') == 'Pending') selected @endif>Oczekujące</option>
                    <option value="Confirmed" @if(request('status') == 'Confirmed') selected @endif>Potwierdzone</option>
                    <option value="Cancelled" @if(request('status') == 'Cancelled') selected @endif>Anulowane</option>
                </select>
            </div>
            <div class="col-md-2 col-6">
                <button type="submit" class="btn btn-primary w-100">Filtruj</button>
            </div>
            <div class="col-md-2 col-6">
                <a href="{{ route('admin.bookings') }}" class="btn btn-outline-secondary w-100">Resetuj</a>
            </div>
        </form>
    </div>
</div>

<div class="card admin-panel">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list mr-2"></i>Lista rezerwacji</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gość</th>
                    <th>E-mail</th>
                    <th>Daty</th>
                    <th>Nocy</th>
                    <th>Cena</th>
                    <th>Status</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td><strong>#{{ $booking->id }}</strong></td>
                    <td>{{ $booking->guest_name }}</td>
                    <td>{{ $booking->guest_email }}</td>
                    <td>
                        <div>{{ $booking->check_in_date->format('d.m.Y') }}</div>
                        <small class="text-muted">do {{ $booking->check_out_date->format('d.m.Y') }}</small>
                    </td>
                    <td>{{ $booking->number_of_nights }}</td>
                    <td><strong>{{ $booking->total_price }} PLN</strong></td>
                    <td>
                        <span class="badge bg-{{ $booking->status_color }}">{{ $booking->status_label }}</span>
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-info">Szczegóły</a>
                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-sm btn-warning">Edytuj</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Brak rezerwacji.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $bookings->links() }}
    </div>
</div>

@endsection
