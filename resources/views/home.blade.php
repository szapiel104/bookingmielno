@extends('layouts.app')

@section('title', 'Rezerwuj Apartament - Mielno')

@section('additional_styles')
<style>
    .home-page {
        --home-bg: #f3f4f6;
        --home-surface: #ffffff;
        --home-primary: #3559e0;
        --home-text: #1f2937;
        --home-muted: #6b7280;
        --home-border: #e5e7eb;
    }

    .home-page .section-surface {
        background: var(--home-surface);
        border: 1px solid var(--home-border);
        border-radius: 1.2rem;
        padding: 2rem;
    }

    .home-page .hero-img,
    .home-page .about-img {
        width: 100%;
        border-radius: 1rem;
        object-fit: cover;
        display: block;
    }

    .home-page .hero-img {
        aspect-ratio: 4 / 3;
    }

    .home-page .about-img {
        aspect-ratio: 16 / 10;
    }

    .home-page .feature-card {
        height: 100%;
        border: 1px solid var(--home-border);
        border-radius: 0.9rem;
        background: var(--home-surface);
    }

    .home-page .gallery-img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 0.9rem;
        border: 1px solid var(--home-border);
        display: block;
    }

    .home-page .review-card {
        height: 100%;
        border: 1px solid var(--home-border);
        border-radius: 0.9rem;
        background: #f9fafb;
    }

    .home-page .review-card footer {
        color: var(--home-muted);
    }

    .home-page .section-title {
        color: var(--home-text);
    }

    .home-page .text-muted-custom {
        color: var(--home-muted);
    }

    .home-page .contact-panel {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        color: #fff;
        border-radius: 1rem;
    }

    .home-page .contact-panel p {
        color: rgba(255, 255, 255, 0.9);
    }

    @media (max-width: 767.98px) {
        .home-page .section-surface {
            padding: 1.25rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5 home-page">
    <!-- Sekcja Hero -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="display-4 fw-bold mb-3 section-title">Nowoczesne apartamenty w Mielnie</h1>
            <p class="lead mb-4 text-muted-custom">Zarezerwuj swój pobyt nad morzem w komfortowych warunkach. Sprawdź dostępność i zarezerwuj online!</p>
            <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg rounded-4 px-5">Rezerwuj teraz</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=80" alt="Apartament" class="hero-img shadow-lg" loading="lazy">
        </div>
    </div>

    <!-- Sekcja O apartamencie -->
    <section class="about-section py-5 section-surface">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="https://images.unsplash.com/photo-1560185007-5f0bb1866cab?auto=format&fit=crop&w=1200&q=80" alt="Wnętrze apartamentu" class="about-img shadow" loading="lazy">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3 section-title">O naszym apartamencie</h2>
                <p class="mb-3 text-muted-custom">Przestronny, nowoczesny apartament w sercu Mielna. Komfortowe łóżka, w pełni wyposażona kuchnia, szybkie Wi-Fi, balkon z widokiem na morze. Idealny na rodzinny wypoczynek lub romantyczny weekend.</p>
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
                <div class="p-4 feature-card">
                    <h5 class="fw-bold mb-2">Lokalizacja</h5>
                    <p class="text-muted-custom mb-0">Centrum Mielna, blisko morza i atrakcji.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 feature-card">
                    <h5 class="fw-bold mb-2">Komfort</h5>
                    <p class="text-muted-custom mb-0">Nowoczesne wnętrza, pełne wyposażenie, klimatyzacja.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 feature-card">
                    <h5 class="fw-bold mb-2">Bezpieczeństwo</h5>
                    <p class="text-muted-custom mb-0">Monitoring, bezpłatny parking, bezpieczna okolica.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sekcja Galeria -->
    <section class="py-5">
        <h2 class="fw-bold text-center mb-4 section-title">Galeria</h2>
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Zdjęcie apartamentu 1" loading="lazy">
            </div>
            <div class="col-6 col-md-3">
                <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Zdjęcie apartamentu 2" loading="lazy">
            </div>
            <div class="col-6 col-md-3">
                <img src="https://images.unsplash.com/photo-1464890100898-a385f744067f?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Zdjęcie apartamentu 3" loading="lazy">
            </div>
            <div class="col-6 col-md-3">
                <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Zdjęcie apartamentu 4" loading="lazy">
            </div>
        </div>
    </section>


    <!-- Sekcja FAQ -->
    <section class="py-5">
        <h2 class="fw-bold text-center mb-4 section-title">Najczęstsze pytania</h2>
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

   
</div>
@endsection
