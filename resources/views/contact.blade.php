@extends('layouts.app')

@section('title', 'Kontakt')

@section('additional_styles')
<style>
    .contact-page {
        --contact-line: #d8dbe1;
        --contact-muted: #4b5563;
        --contact-accent: #2fc96f;
        --contact-dark: #0a1017;
        font-family: 'Space Grotesk', sans-serif;
    }

    .contact-page .hero-panel {
        border: 1px solid var(--contact-line);
        border-radius: 1.4rem;
        padding: 2.2rem;
        background: linear-gradient(130deg, #f7f8f9 0%, #edf0f2 100%);
    }

    .contact-page .hero-panel h1 {
        font-size: clamp(2rem, 4vw, 3rem);
        line-height: 1.05;
        font-weight: 700;
    }

    .contact-page .hero-panel p {
        color: var(--contact-muted);
        max-width: 48ch;
    }

    .contact-page .info-card {
        border: 1px solid var(--contact-line);
        border-radius: 1rem;
        background: #f7f8f9;
        padding: 1.2rem;
        height: 100%;
    }

    .contact-page .info-card .label {
        display: block;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        margin-bottom: 0.35rem;
        font-weight: 700;
    }

    .contact-page .info-card .value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .contact-page .gallery-tile {
        border-radius: 0.9rem;
        overflow: hidden;
        border: 1px solid var(--contact-line);
    }

    .contact-page .gallery-tile img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        display: block;
    }

    .contact-page .cta-dark {
        margin-top: 2rem;
        background: var(--contact-dark);
        color: #f4f8ff;
        border-radius: 1.2rem;
        padding: 1.8rem;
    }

    .contact-page .btn-accent {
        border: 0;
        border-radius: 999px;
        padding: 0.78rem 1.4rem;
        font-weight: 700;
        background: var(--contact-accent);
        color: #03200e;
    }

    .contact-page .btn-accent:hover {
        background: #1bb65a;
        color: #03150a;
    }

    @media (max-width: 767.98px) {
        .contact-page .hero-panel,
        .contact-page .cta-dark {
            padding: 1.35rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5 contact-page">
    <section class="hero-panel mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h1 class="mb-3">Porozmawiajmy o wynajmie apartamentu</h1>
                <p class="mb-4">Masz pytania o dostępność, wyposażenie apartamentu albo warunki pobytu? Skontaktuj się z nami, a szybko pomożemy dobrać najlepszy termin.</p>
                <a href="{{ route('booking.index') }}" class="btn btn-accent">Przejdź do rezerwacji</a>
            </div>
            <div class="col-lg-5">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80" alt="Kontakt i apartament" class="img-fluid rounded-4 shadow-sm" loading="lazy">
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <article class="info-card">
                    <span class="label">Lokalizacja</span>
                    <p class="value">Mielno, Polska</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="info-card">
                    <span class="label">Telefon</span>
                    <p class="value">{{ \App\Models\Setting::get('phone', '+48 123 456 789') }}</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="info-card">
                    <span class="label">E-mail</span>
                    <p class="value">{{ \App\Models\Setting::get('notification_email', 'admin@Mielno.pl') }}</p>
                </article>
            </div>
        </div>
    </section>

    <section>
        <h2 class="fw-bold mb-3">Zobacz klimat apartamentu i okolicy</h2>
        <div class="row g-3">
            <div class="col-6 col-lg-3"><div class="gallery-tile"><img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80" alt="Salon apartamentu" loading="lazy"></div></div>
            <div class="col-6 col-lg-3"><div class="gallery-tile"><img src="https://images.unsplash.com/photo-1560185007-cde436f6a4d0?auto=format&fit=crop&w=900&q=80" alt="Sypialnia apartamentu" loading="lazy"></div></div>
            <div class="col-6 col-lg-3"><div class="gallery-tile"><img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80" alt="Aneks kuchenny" loading="lazy"></div></div>
            <div class="col-6 col-lg-3"><div class="gallery-tile"><img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80" alt="Plaża blisko apartamentu" loading="lazy"></div></div>
        </div>
    </section>

    <section class="cta-dark">
        <div class="row g-3 align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-2">Szybki kontakt i jasne warunki wynajmu</h3>
                <p class="mb-0 text-light">Możesz od razu przejść do formularza rezerwacji, a my potwierdzimy szczegóły pobytu i odpowiemy na wszystkie pytania.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('booking.index') }}" class="btn btn-accent">Zarezerwuj termin</a>
            </div>
        </div>
    </section>
</div>
@endsection