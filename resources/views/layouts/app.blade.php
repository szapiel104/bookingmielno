<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookingMielno - Rezerwacje Apartamentów')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #1a1a2e;
            --bs-secondary: #0f3460;
            --bs-success: #16a34a;
            --bs-danger: #dc2626;
            --bs-warning: #ea580c;
            --bs-info: #0891b2;
            --bs-light: #f8f9fa;
            --bs-dark: #1a1a2e;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .hero-section {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
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
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }

        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            border: none;
            padding: 12px 40px;
            font-weight: 600;
            border-radius: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15, 52, 96, 0.3);
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
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .flatpickr-calendar {
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
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
    </style>
    @yield('additional_styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">📍 BookingMielno</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/#about">O nas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#booking">Rezerwacja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#contact">Kontakt</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Panel admina</a>
                        </li>
                    @endguest
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Panel Admina</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Wyloguj</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>{{ \App\Models\Setting::get('footer_text', '© 2024 BookingMielno. Wszystkie prawa zastrzeżone.') }}</p>
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
