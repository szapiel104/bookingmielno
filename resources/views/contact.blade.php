@extends('layouts.app')
@section('title', 'Kontakt')
@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Kontakt</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-white p-4 rounded-4 shadow-sm">
                <h5>📍 Adres</h5>
                <p>Mielno, Polska</p>
                <h5>📞 Telefon</h5>
                <p>{{ \App\Models\Setting::get('phone', '+48 123 456 789') }}</p>
                <h5>📧 E-mail</h5>
                <p>{{ \App\Models\Setting::get('notification_email', 'admin@Mielno.pl') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection