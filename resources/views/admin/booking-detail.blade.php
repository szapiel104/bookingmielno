@extends('layouts.admin')

@section('title', 'Szczegóły Rezerwacji - Panel Administratora')
@section('page_title', 'Rezerwacja #' . $booking->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Pełne dane rezerwacji i panel obsługi statusu.</p>
    <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-1"></i>Powrót</a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card admin-panel mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user mr-2"></i>Dane rezerwacji</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Dane Gościa</h6>
                        <p><strong>Imię i Nazwisko:</strong> {{ $booking->guest_name }}</p>
                        <p><strong>E-mail:</strong> <a href="mailto:{{ $booking->guest_email }}">{{ $booking->guest_email }}</a></p>
                        <p><strong>Telefon:</strong> <a href="tel:{{ $booking->guest_phone }}">{{ $booking->guest_phone }}</a></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Daty Pobytu</h6>
                        <p><strong>Przyjazd:</strong> {{ $booking->check_in_date->format('d.m.Y (l)') }}</p>
                        <p><strong>Wyjazd:</strong> {{ $booking->check_out_date->format('d.m.Y (l)') }}</p>
                        <p><strong>Liczba nocy:</strong> {{ $booking->number_of_nights }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card admin-panel mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-money-bill-wave mr-2"></i>Podsumowanie ceny</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Cena za noc:</strong></p>
                        <p class="h5">{{ $booking->price_per_night }} PLN</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Liczba nocy:</strong></p>
                        <p class="h5">{{ $booking->number_of_nights }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Razem:</strong></p>
                        <p class="h5 text-success">{{ $booking->total_price }} PLN</p>
                    </div>
                </div>
            </div>
        </div>

        @if($booking->special_requests)
        <div class="card admin-panel mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-comment-dots mr-2"></i>Specjalne życzenia</h3>
            </div>
            <div class="card-body">
                {{ $booking->special_requests }}
            </div>
        </div>
        @endif

        <div class="card admin-panel mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-sticky-note mr-2"></i>Notatki administratora</h3>
            </div>
            <div class="card-body">
                <p style="white-space: pre-wrap;">{{ $booking->admin_notes ?? 'Brak notatek' }}</p>
            </div>
        </div>

        @if($booking->confirmed_at)
        <div class="card admin-panel mb-4">
            <div class="card-body">
                <p class="text-muted mb-0">Potwierdzona: <strong>{{ $booking->confirmed_at->format('d.m.Y H:i') }}</strong></p>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card admin-panel">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tasks mr-2"></i>Zmień status</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending" @if($booking->status == 'Pending') selected @endif>Oczekująca</option>
                            <option value="Confirmed" @if($booking->status == 'Confirmed') selected @endif>Potwierdzona</option>
                            <option value="Cancelled" @if($booking->status == 'Cancelled') selected @endif>Anulowana</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notatka Administratora</label>
                        <textarea name="admin_notes" class="form-control" rows="4" placeholder="Dodaj krótką notatkę dla zespołu">{{ $booking->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Zaktualizuj</button>
                </form>

                <hr>

                <form action="{{ route('admin.bookings.delete', $booking) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę rezerwację?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">Usuń Rezerwację</button>
                </form>
            </div>
        </div>

        <div class="card admin-panel mt-3">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-traffic-light mr-2"></i>Status</h3>
            </div>
            <div class="card-body text-center">
                <span class="badge" style="background-color: #{{ ['Pending' => 'ea580c', 'Confirmed' => '16a34a', 'Cancelled' => 'dc2626'][$booking->status] ?? 'ccc' }}; padding: 10px 14px; font-size: 1rem;">
                    {{ ['Pending' => 'Oczekująca', 'Confirmed' => 'Potwierdzona', 'Cancelled' => 'Anulowana'][$booking->status] ?? 'Nieznana' }}
                </span>
            </div>
        </div>
    </div>
</div>

@endsection
