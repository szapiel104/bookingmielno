@extends('layouts.admin')

@section('title', 'Rezerwacje - Panel Administratora')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Rezerwacje</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">← Dashboard</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Szukaj gościa..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Wszystkie statusy</option>
                    <option value="Pending" @if(request('status') == 'Pending') selected @endif>Oczekujące</option>
                    <option value="Confirmed" @if(request('status') == 'Confirmed') selected @endif>Potwierdzone</option>
                    <option value="Cancelled" @if(request('status') == 'Cancelled') selected @endif>Anulowane</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtruj</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.bookings') }}" class="btn btn-outline-secondary w-100">Resetuj</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">📅 Lista Rezerwacji</h5>
    </div>
    <div class="table-responsive">
        <table class="table">
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
                        {{ $booking->check_in_date->format('d.m.Y') }} - {{ $booking->check_out_date->format('d.m.Y') }}
                    </td>
                    <td>{{ $booking->number_of_nights }}</td>
                    <td><strong>{{ $booking->total_price }} PLN</strong></td>
                    <td>
                        <span class="badge bg-{{ $booking->status_color }}">{{ $booking->status_label }}</span>
                    </td>
                    <td>
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
