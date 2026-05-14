<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administratora - BookingMielno')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        :root {
            --brand-1: #16324f;
            --brand-2: #235a75;
            --brand-3: #f2a541;
            --panel-bg: #eef3f7;
            --panel-border: #d8e0e8;
            --text-strong: #0f2235;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: radial-gradient(circle at 10% 10%, #f7fbff 0%, #edf4fb 35%, #e9eff6 100%);
            color: var(--text-strong);
        }

        .main-header.navbar {
            border-bottom: 0;
            background: linear-gradient(120deg, var(--brand-1) 0%, var(--brand-2) 62%, #2e728e 100%);
            box-shadow: 0 8px 24px rgba(18, 42, 69, 0.25);
        }

        .main-header .nav-link,
        .main-header .navbar-brand {
            color: #fff !important;
        }

        .main-sidebar {
            background: linear-gradient(180deg, #0f2235 0%, #122a43 45%, #173753 100%);
        }

        .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff !important;
            font-weight: 700;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            color: #d9e7f4;
            border-radius: 0.6rem;
            margin: 0.2rem 0.5rem;
            transition: 0.2s ease-in-out;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.12);
            color: #fff;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: linear-gradient(120deg, rgba(242, 165, 65, 0.95), rgba(255, 195, 97, 0.95));
            color: #1b2b38;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(242, 165, 65, 0.32);
        }

        .content-wrapper {
            background: transparent;
        }

        .content-header h1 {
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .admin-panel {
            border: 1px solid var(--panel-border);
            border-radius: 16px;
            box-shadow: 0 12px 28px rgba(17, 40, 66, 0.09);
            background: #fff;
        }

        .card {
            border: 1px solid var(--panel-border);
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(17, 40, 66, 0.08);
        }

        .card-header {
            background: linear-gradient(120deg, var(--brand-1) 0%, var(--brand-2) 100%);
            color: #fff;
            border-bottom: 0;
            border-radius: 14px 14px 0 0 !important;
        }

        .small-box {
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(18, 42, 69, 0.12);
        }

        .small-box > .inner h3 {
            font-size: 2.1rem;
            font-weight: 700;
        }

        .btn-primary {
            border-color: transparent;
            background: linear-gradient(120deg, var(--brand-1) 0%, var(--brand-2) 100%);
        }

        .btn-primary:hover {
            background: linear-gradient(120deg, #214e73 0%, #2f7392 100%);
            border-color: transparent;
        }

        .page-enter {
            animation: pageEnter 0.35s ease-out;
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @yield('additional_styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Panel administratora</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item mr-2 d-none d-md-block text-white-50 small">
                Zalogowany: <strong class="text-white">{{ auth()->user()->name }}</strong>
            </li>
            <li class="nav-item mr-2">
                <a href="/" class="btn btn-sm btn-light"><i class="fas fa-external-link-alt mr-1"></i>Strona</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-1"></i>Wyloguj
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <span class="brand-text">BookingMielno Admin</span>
        </a>

        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.bookings') }}" class="nav-link @if(request()->routeIs('admin.bookings*')) active @endif">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Rezerwacje</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.content-editor') }}" class="nav-link @if(request()->routeIs('admin.content-editor')) active @endif">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Edytor treści</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings') }}" class="nav-link @if(request()->routeIs('admin.settings')) active @endif">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Ustawienia</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">@yield('page_title', 'Panel administratora')</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content pb-4">
            <div class="container-fluid page-enter">
                @if($errors->any())
                    <div class="alert alert-danger admin-panel">
                        <strong><i class="fas fa-exclamation-triangle mr-1"></i>Wykryto błędy:</strong>
                        <ul class="mb-0 mt-2 pl-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show admin-panel" role="alert">
                        <i class="fas fa-check-circle mr-1"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer text-sm">
        <strong>BookingMielno</strong> <span class="text-muted">| panel administracyjny</span>
        <div class="float-right d-none d-sm-inline-block">
            Laravel {{ app()->version() }}
        </div>
    </footer>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@yield('additional_scripts')
</body>
</html>
