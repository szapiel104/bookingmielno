<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mielno - Rezerwacje Apartamentów')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #7C83FD;
            --bs-secondary: #96BAFF;
            --bs-success: #A8E6CF;
            --bs-danger: #FF6A6A;
            --bs-warning: #FFD6E0;
            --bs-info: #B8FFF9;
            --bs-light: #F9F9F9;
            --bs-dark: #22223B;
        }
        
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #f3f4f6;
        }

        .navbar {
            background: #f7f7f8;
            border-bottom: 1px solid #e2e2e2;
            box-shadow: none;
            min-height: 92px;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: 0.04em;
            color: #111218 !important;
            text-transform: uppercase;
        }

        .navbar-brand .brand-dot {
            display: inline-block;
            margin: 0 10px;
            color: #111218;
        }

        .main-nav {
            gap: 8px;
        }

        .main-nav .nav-link {
            color: #151821 !important;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 10px 16px !important;
            border-radius: 12px;
            transition: background-color 0.2s ease;
        }

        .main-nav .nav-link:hover,
        .main-nav .nav-link:focus {
            color: #151821 !important;
            background: #ececef;
        }

        .navbar-collapse-desktop {
            display: none;
        }

        @media (min-width: 992px) {
            .navbar-toggler {
                display: none !important;
            }

            .navbar-collapse-desktop {
                display: flex !important;
                align-items: center;
                flex: 1;
            }

            .offcanvas {
                display: none !important;
            }
        }

        .offcanvas {
            width: 80% !important;
            max-width: 360px;
            background: #f7f7f8;
        }

        .offcanvas-header {
            background: #f7f7f8;
            border-bottom: 1px solid #e2e2e2;
            padding: 20px;
        }

        .offcanvas-body {
            padding: 20px 0;
        }

        .offcanvas-body .nav-link {
            padding: 15px 20px !important;
            color: #151821 !important;
            font-weight: 600;
            font-size: 1.05rem;
            border-left: 4px solid transparent;
            transition: all 0.2s ease;
        }

        .offcanvas-body .nav-link:hover {
            background: #ececef;
            border-left-color: #7C83FD;
        }

        .offcanvas-body .nav-cta {
            margin: 10px 20px;
            display: block;
            text-align: center;
        }

        .btn-close {
            filter: invert(0.2) sepia(0.6);
        }

        .nav-cta {
            border: 1.5px solid #151821;
            color: #151821;
            background: transparent;
            font-weight: 700;
            border-radius: 999px;
            padding: 12px 24px;
            line-height: 1;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .nav-cta:hover {
            color: #151821;
            background: #ececef;
        }

        .lang-switch {
            color: #151821;
            font-weight: 700;
            text-decoration: none;
            padding: 8px 10px;
            border-radius: 10px;
        }

        .lang-switch:hover {
            color: #151821;
            background: #ececef;
        }

        .eu-badge {
            width: 54px;
            height: 36px;
            border-radius: 4px;
            background: #1e53b3;
            border: 1px solid #d8d8d8;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffd948;
            font-size: 0.65rem;
            font-weight: 700;
        }

        .eu-badge::before {
            content: 'UE';
        }

        .hero-section {
            background: linear-gradient(135deg, #7C83FD 0%, #96BAFF 100%);
            color: #22223B;
            padding: 100px 0;
            text-align: center;
            border-radius: 0 0 2rem 2rem;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 40px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .booking-form {
            background: #fff;
            padding: 40px;
            border-radius: 2rem;
            box-shadow: 0 10px 30px rgba(124,131,253,0.10);
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }

        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            border-radius: 1.2rem;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #7C83FD 0%, #96BAFF 100%);
            border: none;
            padding: 12px 40px;
            font-weight: 600;
            border-radius: 1.5rem;
            color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(124,131,253,0.15);
            background: linear-gradient(135deg, #96BAFF 0%, #7C83FD 100%);
        }

        .price-display {
            background: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }

        .price-display h3 {
            color: #0f3460;
            margin-bottom: 10px;
        }

        .price-big {
            font-size: 2.5rem;
            font-weight: 700;
            color: #16a34a;
        }

        .about-section {
            padding: 80px 0;
            background: white;
        }

        .about-section h2 {
            color: #1a1a2e;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
        }

        .contact-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: white;
            text-align: center;
        }

        .contact-section h2 {
            margin-bottom: 30px;
            font-weight: 700;
        }

        footer {
            background: #1a1a2e;
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-top: 60px;
        }

        .calendar-container {
            background: #fff;
            padding: 20px;
            border-radius: 2rem;
            box-shadow: 0 4px 16px rgba(124,131,253,0.10);
            margin: 20px 0;
        }

        .fc-daygrid-day {
            font-size: 0.9rem;
        }

        .fc-daygrid-event {
            background-color: #dc2626 !important;
            color: white !important;
            border: none;
            border-radius: 4px;
            padding: 2px 4px;
            font-size: 0.8rem;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert {
            border: none;
            border-radius: 8px;
        }

        .calendar-event {
            background: #dc2626;
            color: white;
            padding: 8px;
            border-radius: 4px;
            font-size: 0.9rem;
            margin: 2px 0;
        }

        @media (max-width: 767.98px) {
            .hero-section {
                padding: 50px 0;
                border-radius: 0 0 1.5rem 1.5rem;
            }

            .hero-section h1 {
                font-size: 2rem;
                margin-bottom: 15px;
            }

            .hero-section p {
                font-size: 1.1rem;
                margin-bottom: 25px;
            }

            .about-section {
                padding: 40px 0;
            }

            .contact-section {
                padding: 40px 0;
            }

            .contact-section h2 {
                margin-bottom: 20px;
                font-size: 1.5rem;
            }

            footer {
                padding: 20px 0;
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .booking-form {
                padding: 20px;
                margin-top: -40px;
            }

            .calendar-container {
                padding: 15px;
            }

            .fc {
                font-size: 0.85rem;
            }

            .fc-daygrid-day-frame {
                min-height: 60px;
            }
        }
    </style>
    @yield('additional_styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-lg-4">
            <a class="navbar-brand" href="/">Art Lake 28</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-controls="offcanvasNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Desktop Menu -->
            <div class="navbar-collapse-desktop">
                <ul class="navbar-nav main-nav mx-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/o-nas">O nas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rezerwacja">Rezerwacja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kontakt">Kontakt</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="/rezerwacja" class="nav-cta">Rezerwuj</a>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Zamknij"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav main-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/o-nas" data-bs-dismiss="offcanvas">O nas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/rezerwacja" data-bs-dismiss="offcanvas">Rezerwacja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/kontakt" data-bs-dismiss="offcanvas">Kontakt</a>
                        </li>
                    </ul>
                    <div class="d-flex flex-column mt-3">
                        <a href="/rezerwacja" class="nav-cta" data-bs-dismiss="offcanvas">Rezerwuj</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>{{ \App\Models\Setting::get('footer_text', '© 2024 Mielno. Wszystkie prawa zastrzeżone.') }}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/pl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @yield('additional_scripts')
</body>
</html>
