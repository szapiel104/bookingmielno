@extends('layouts.app')

@section('title', 'O nas')

@section('additional_styles')
<style>
    .about-page {
        --about-bg: #ececee;
        --about-surface: #f8f8f9;
        --about-line: #d7d9de;
        --about-text: #111827;
        --about-muted: #4b5563;
        --about-accent: #2fc96f;
        --about-dark: #06090f;
        font-family: 'Space Grotesk', sans-serif;
        color: var(--about-text);
    }

    .about-page .eyebrow {
        display: inline-block;
        margin-bottom: 1rem;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        background: #e6f7ec;
        color: #0c7a3a;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .about-page .hero-block {
        background: linear-gradient(130deg, #f6f7f8 0%, #eef1f3 100%);
        border: 1px solid var(--about-line);
        border-radius: 1.5rem;
        padding: 2.5rem;
    }

    .about-page .hero-title {
        font-size: clamp(2rem, 4vw, 3.15rem);
        font-weight: 700;
        line-height: 1.06;
    }

    .about-page .hero-copy {
        color: var(--about-muted);
        max-width: 46ch;
        font-size: 1.08rem;
    }

    .about-page .btn-accent {
        border: 0;
        border-radius: 999px;
        padding: 0.8rem 1.45rem;
        font-weight: 700;
        background: var(--about-accent);
        color: #04210f;
    }

    .about-page .btn-accent:hover {
        background: #1bb65a;
        color: #03180b;
    }

    .about-page .person-tile {
        border-radius: 0.9rem;
        overflow: hidden;
        background: #dde1e8;
        aspect-ratio: 1 / 1;
    }

    .about-page .person-tile img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .about-page .value-wrap {
        background: var(--about-surface);
        border: 1px solid var(--about-line);
        border-radius: 1.25rem;
        padding: 2rem;
    }

    .about-page .value-pill {
        border: 1px solid #bbc2cd;
        border-radius: 999px;
        padding: 0.8rem 1.15rem;
        text-align: center;
        font-weight: 600;
        background: #f0f2f5;
        color: #111827;
    }

    .about-page .kpi {
        background: #f4f5f7;
        border: 1px solid var(--about-line);
        border-radius: 1rem;
        padding: 1.35rem;
        height: 100%;
    }

    .about-page .kpi strong {
        font-size: 1.7rem;
        line-height: 1;
    }

    .about-page .expert-section {
        margin-top: 4rem;
        background: var(--about-dark);
        color: #f2f6f9;
        border-radius: 1.5rem;
        padding: 2.25rem;
    }

    .about-page .expert-card {
        border: 1px solid rgba(210, 221, 235, 0.12);
        background: rgba(255, 255, 255, 0.03);
        border-radius: 1rem;
        padding: 1rem;
        color: #d8e0ea;
    }

    .about-page .expert-image {
        border-radius: 0.8rem;
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        display: block;
    }

    .about-page .cta-band {
        margin-top: 3.5rem;
        background: #f2f4f6;
        border: 1px solid var(--about-line);
        border-radius: 1.25rem;
        padding: 2rem;
    }

    @media (max-width: 767.98px) {
        .about-page .hero-block,
        .about-page .value-wrap,
        .about-page .expert-section,
        .about-page .cta-band {
            padding: 1.35rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5 about-page">
    <section class="hero-block mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="eyebrow">O nas</span>
                <h1 class="hero-title mb-3">Tworzymy komfortowy apartament na spokojny pobyt w Mielnie</h1>
                <p class="hero-copy mb-4">Dbamy o każdy detal pobytu: od czystości i wyposażenia wnętrza, po szybki kontakt i prostą rezerwację. Chcemy, żeby wypoczynek nad morzem był wygodny od pierwszego dnia.</p>
                <a href="{{ route('booking.index') }}" class="btn btn-accent">Sprawdź rezerwację</a>
            </div>
            <div class="col-lg-5">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=80" alt="Wnętrze apartamentu" class="img-fluid rounded-4 shadow-sm" loading="lazy">
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="row g-3">
            <div class="col-6 col-md-3 col-lg-2"><div class="person-tile"><img src="https://images.unsplash.com/photo-1496417263034-38ec4f0b665a?auto=format&fit=crop&w=500&q=80" alt="Salon apartamentu" loading="lazy"></div></div>
            <div class="col-6 col-md-3 col-lg-2"><div class="person-tile"><img src="https://images.unsplash.com/photo-1560185007-cde436f6a4d0?auto=format&fit=crop&w=500&q=80" alt="Sypialnia apartamentu" loading="lazy"></div></div>
            <div class="col-6 col-md-3 col-lg-2"><div class="person-tile"><img src="https://images.unsplash.com/photo-1560184897-ae75f418493e?auto=format&fit=crop&w=500&q=80" alt="Jadalnia apartamentu" loading="lazy"></div></div>
            <div class="col-6 col-md-3 col-lg-2"><div class="person-tile"><img src="https://images.unsplash.com/photo-1560185008-a33f3aaf5846?auto=format&fit=crop&w=500&q=80" alt="Łazienka apartamentu" loading="lazy"></div></div>
            <div class="col-6 col-md-3 col-lg-2"><div class="person-tile"><img src="https://images.unsplash.com/photo-1501117716987-c8e1ecb21072?auto=format&fit=crop&w=500&q=80" alt="Taras apartamentu" loading="lazy"></div></div>
            <div class="col-6 col-md-3 col-lg-2"><div class="person-tile"><img src="https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?auto=format&fit=crop&w=500&q=80" alt="Plaża w Mielnie" loading="lazy"></div></div>
        </div>
    </section>

    <section class="value-wrap mb-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Dostarczamy pobyt, który łączy wygodę, estetykę i szybkie wsparcie.</h2>
                <p class="mb-0 text-secondary">Stawiamy na prosty i pewny model wynajmu: czytelne warunki, błyskawiczny kontakt oraz apartament przygotowany dokładnie tak, jak pokazujemy na zdjęciach.</p>
            </div>
            <div class="col-lg-6">
                <div class="d-grid gap-3">
                    <div class="value-pill">Szybka rezerwacja i sprawny kontakt</div>
                    <div class="value-pill">Wyposażenie gotowe na dłuższy pobyt</div>
                    <div class="value-pill">Lokalizacja blisko plaży i centrum</div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <article class="kpi">
                    <strong>120+</strong>
                    <p class="mb-0 mt-2 text-secondary">udanych pobytów i pozytywnych opinii od gości, którzy wracają do nas co sezon.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="kpi">
                    <strong>50+</strong>
                    <p class="mb-0 mt-2 text-secondary">rezerwacji rocznie obsługiwanych bezpośrednio, z czytelnym procesem i szybką odpowiedzią.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="kpi">
                    <strong>13+</strong>
                    <p class="mb-0 mt-2 text-secondary">lat doświadczenia w organizowaniu wygodnego wypoczynku nad morzem.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="expert-section">
        <h3 class="fw-bold mb-3">Apartament zaprojektowany pod realne potrzeby gości</h3>
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-4"><img class="expert-image" src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80" alt="Aneks kuchenny" loading="lazy"></div>
            <div class="col-6 col-lg-4"><img class="expert-image" src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=900&q=80" alt="Sypialnia i komfortowe łóżko" loading="lazy"></div>
            <div class="col-6 col-lg-4"><img class="expert-image" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80" alt="Nadmorska okolica" loading="lazy"></div>
        </div>
        <div class="row g-3">
            <div class="col-md-4"><div class="expert-card"><h6 class="fw-bold">Wygoda</h6><p class="mb-0 small">Przestrzeń, która sprawdza się zarówno na weekend, jak i dłuższy pobyt.</p></div></div>
            <div class="col-md-4"><div class="expert-card"><h6 class="fw-bold">Funkcjonalność</h6><p class="mb-0 small">Kompletne wyposażenie, szybkie Wi-Fi i wszystko, czego potrzeba na miejscu.</p></div></div>
            <div class="col-md-4"><div class="expert-card"><h6 class="fw-bold">Lokalizacja</h6><p class="mb-0 small">Blisko plaży, restauracji i spacerowych tras, bez utraty spokoju pobytu.</p></div></div>
        </div>
    </section>

    <section class="cta-band">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <h4 class="fw-bold mb-2">Chcesz poznać apartament i sprawdzić dostępne terminy?</h4>
                <p class="mb-0 text-secondary">Napisz do nas lub od razu przejdź do rezerwacji. Odpowiadamy szybko i konkretnie.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-outline-dark rounded-pill px-4 me-2">Kontakt</a>
                <a href="{{ route('booking.index') }}" class="btn btn-accent">Rezerwuj</a>
            </div>
        </div>
    </section>
</div>
@endsection
