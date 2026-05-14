@extends('layouts.app')

@section('title', 'Rezerwuj Apartament - Mielno')

@section('additional_styles')
<style>
    .flatpickr-day.booked {
        background: #dc2626;
        color: white;
    }

    .flatpickr-day.disabled {
        background: #fca5a5;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <!-- Sekcja Hero -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="display-4 fw-bold mb-3">Nowoczesne apartamenty w Mielnie</h1>
            <p class="lead mb-4">Zarezerwuj swój pobyt nad morzem w komfortowych warunkach. Sprawdź dostępność i zarezerwuj online!</p>
            <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg rounded-4 px-5">Rezerwuj teraz</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="/public/build/assets/apartament.jpg" alt="Apartament" class="img-fluid rounded-4 shadow-lg" style="max-height: 340px; object-fit: cover;">
        </div>
    </div>

    <!-- Sekcja O apartamencie -->
    <section class="about-section py-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="/public/build/assets/wnetrze.jpg" alt="Wnętrze apartamentu" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">O naszym apartamencie</h2>
                <p class="mb-3">Przestronny, nowoczesny apartament w sercu Mielna. Komfortowe łóżka, w pełni wyposażona kuchnia, szybkie Wi-Fi, balkon z widokiem na morze. Idealny na rodzinny wypoczynek lub romantyczny weekend.</p>
                <ul class="list-unstyled">
                    <li>✔️ 2 sypialnie, salon, kuchnia</li>
                    <li>✔️ 5 minut do plaży</li>
                    <li>✔️ Bezpłatny parking</li>
                    <li>✔️ Klimatyzacja, TV, Wi-Fi</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Sekcja Zalety -->
    <section class="py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded-4 shadow-sm bg-white h-100">
                    <h5 class="fw-bold mb-2">Lokalizacja</h5>
                    <p>Centrum Mielna, blisko morza i atrakcji.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded-4 shadow-sm bg-white h-100">
                    <h5 class="fw-bold mb-2">Komfort</h5>
                    <p>Nowoczesne wnętrza, pełne wyposażenie, klimatyzacja.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded-4 shadow-sm bg-white h-100">
                    <h5 class="fw-bold mb-2">Bezpieczeństwo</h5>
                    <p>Monitoring, bezpłatny parking, bezpieczna okolica.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sekcja Galeria -->
    <section class="py-5">
        <h2 class="fw-bold text-center mb-4">Galeria</h2>
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <img src="/public/build/assets/galeria1.jpg" class="img-fluid rounded-4 shadow-sm" alt="Zdjęcie apartamentu 1">
            </div>
            <div class="col-6 col-md-3">
                <img src="/public/build/assets/galeria2.jpg" class="img-fluid rounded-4 shadow-sm" alt="Zdjęcie apartamentu 2">
            </div>
            <div class="col-6 col-md-3">
                <img src="/public/build/assets/galeria3.jpg" class="img-fluid rounded-4 shadow-sm" alt="Zdjęcie apartamentu 3">
            </div>
            <div class="col-6 col-md-3">
                <img src="/public/build/assets/galeria4.jpg" class="img-fluid rounded-4 shadow-sm" alt="Zdjęcie apartamentu 4">
            </div>
        </div>
    </section>

    <!-- Sekcja Opinie -->
    <section class="py-5 bg-white rounded-4 shadow-sm my-5">
        <h2 class="fw-bold text-center mb-4">Opinie gości</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <blockquote class="blockquote p-4 rounded-4 bg-light shadow-sm">
                    <p>"Świetna lokalizacja, czysto i bardzo wygodnie. Polecam!"</p>
                    <footer class="blockquote-footer">Anna, Poznań</footer>
                </blockquote>
            </div>
            <div class="col-md-4 mb-3">
                <blockquote class="blockquote p-4 rounded-4 bg-light shadow-sm">
                    <p>"Apartament spełnił wszystkie nasze oczekiwania. Wrócimy!"</p>
                    <footer class="blockquote-footer">Marek, Warszawa</footer>
                </blockquote>
            </div>
        </div>
    </section>

    <!-- Sekcja FAQ -->
    <section class="py-5">
        <h2 class="fw-bold text-center mb-4">Najczęstsze pytania</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        Czy apartament jest dostępny przez cały rok?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Tak, apartament można rezerwować przez cały rok.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        Czy jest możliwość anulowania rezerwacji?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Tak, szczegóły anulacji znajdziesz w regulaminie rezerwacji.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sekcja Kontakt -->
    <section class="contact-section py-5 rounded-4 my-5">
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">Kontakt</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <h5>📍 Adres</h5>
                    <p>Mielno, Polska</p>
                </div>
                <div class="col-md-4">
                    <h5>📞 Telefon</h5>
                    <p>{{ \App\Models\Setting::get('phone', '+48 123 456 789') }}</p>
                </div>
                <div class="col-md-4">
                    <h5>📧 E-mail</h5>
                    <p>{{ \App\Models\Setting::get('notification_email', 'admin@Mielno.pl') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'pl',
            height: 400,
            events: [
                { start: '2026-05-15', end: '2026-05-17', display: 'background', backgroundColor: '#FF6A6A' },
                { start: '2026-05-20', end: '2026-05-22', display: 'background', backgroundColor: '#FF6A6A' }
            ]
        });
        calendar.render();
    });
</script>
@endsection
