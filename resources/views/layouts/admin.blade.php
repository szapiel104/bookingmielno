<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administratora - BookingMielno')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #1a1a2e;
            --bs-secondary: #0f3460;
            --bs-success: #16a34a;
            --bs-danger: #dc2626;
            --bs-warning: #ea580c;
            --bs-info: #0891b2;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .sidebar {
            background: white;
            min-height: 100vh;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 56px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav li {
            padding: 0;
        }

        .sidebar-nav a {
            display: block;
            padding: 12px 20px;
            color: #1a1a2e;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: #f0f9ff;
            border-left-color: #0f3460;
            color: #0f3460;
            font-weight: 600;
        }

        .main-content {
            padding: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .card-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: white;
            border: none;
            padding: 15px 20px;
            font-weight: 600;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: #f8f9fa;
            font-weight: 600;
            color: #1a1a2e;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .badge {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            padding: 10px 12px;
            border-radius: 6px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0f3460 0%, #1a1a2e 100%);
        }

        .stats-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card h5 {
            color: #999;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stats-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        .alert {
            border: none;
            border-radius: 6px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
    </style>
    @yield('additional_styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">📍 BookingMielno - Panel Admina</a>
            <div class="ms-auto">
                <span class="text-white me-3">{{ auth()->user()->name }}</span>
                <a href="{{ route('logout') }}" class="btn btn-sm btn-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Wyloguj
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 0;">
        <div class="row">
            <div class="col-md-3 col-lg-2">
                <ul class="sidebar-nav">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="@if(request()->routeIs('admin.dashboard')) active @endif">
                            📊 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings') }}" class="@if(request()->routeIs('admin.bookings*')) active @endif">
                            📅 Rezerwacje
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.content-editor') }}" class="@if(request()->routeIs('admin.content-editor')) active @endif">
                            ✏️ Edytor Treści
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings') }}" class="@if(request()->routeIs('admin.settings')) active @endif">
                            ⚙️ Ustawienia
                        </a>
                    </li>
                    <li>
                        <a href="/" class="mt-5 pt-3 border-top">
                            ← Powrót na stronę
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-lg-10 main-content">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Błędy:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    @yield('additional_scripts')
</body>
</html>
