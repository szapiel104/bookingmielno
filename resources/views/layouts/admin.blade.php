<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administratora - Mielno')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        :root {
            --accent: #2f6fed;
            --accent-hover: #255ddb;
            --bg: #f4f7fb;
            --bg-elevated: #ffffff;
            --bg-soft: #eef3f8;
            --border: #d8e0ea;
            --text: #0f172a;
            --text-muted: #5f6c80;
            --sidebar-bg: #f9fbff;
            --topbar-bg: #ffffff;
            --shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            --accent-rgb: 47, 111, 237;
            --danger: #d7444e;
            --success: #2a9d62;
            --warning: #d08a2e;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .main-header.navbar {
            border-bottom: 1px solid var(--border);
            background: var(--topbar-bg);
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.06);
        }

        .main-header .nav-link,
        .main-header .navbar-brand {
            color: var(--text) !important;
        }

        .main-header .text-white-50,
        .main-header .text-white {
            color: var(--text-muted) !important;
        }

        .main-sidebar {
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
        }

        .brand-link {
            background: var(--sidebar-bg) !important;
            border-bottom: 1px solid var(--border);
            color: var(--text) !important;
            font-weight: 700;
            padding: 0.95rem 1rem;
        }

        .brand-link .brand-text {
            color: var(--text) !important;
            opacity: 1 !important;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            color: var(--text-muted);
            border-radius: 0;
            margin: 0;
            padding: 0.68rem 1rem;
            transition: background-color 0.15s ease, color 0.15s ease;
            font-weight: 500;
            border-left: 3px solid transparent;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background-color: var(--bg-soft);
            color: var(--text);
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link .nav-icon {
            font-size: 1.05rem;
            margin-right: 0.35rem;
            color: currentColor;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: var(--bg-soft);
            color: var(--text);
            font-weight: 600;
            box-shadow: none;
            border-left-color: var(--accent);
        }

        .content-wrapper {
            background: transparent;
        }

        .content-header h1 {
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .admin-panel {
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            background: var(--bg-elevated);
        }

        .card {
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
            background: var(--bg-elevated);
            color: var(--text);
        }

        .card-header {
            background: var(--bg-soft);
            color: var(--text);
            border-bottom: 1px solid var(--border);
            border-radius: 14px 14px 0 0 !important;
        }

        .metric-card {
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--bg-elevated);
            padding: 1rem;
            box-shadow: var(--shadow);
            height: 100%;
            margin-bottom: 1rem;
        }

        .metric-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }

        .metric-value {
            font-size: 2rem;
            line-height: 1;
            margin: 0.35rem 0;
            font-weight: 700;
            color: var(--text);
        }

        .metric-link {
            display: inline-block;
            margin-top: 0.1rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .metric-card.is-pending .metric-value {
            color: var(--warning);
        }

        .metric-card.is-confirmed .metric-value {
            color: var(--success);
        }

        .metric-card.is-cancelled .metric-value {
            color: var(--danger);
        }

        .btn-primary {
            border-color: var(--accent);
            background: var(--accent);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            border-color: var(--accent-hover);
        }

        .btn-outline-secondary,
        .btn-secondary {
            border-color: var(--border);
            color: var(--text);
            background: var(--bg-elevated);
        }

        .btn-outline-secondary:hover,
        .btn-secondary:hover {
            background: var(--bg-soft);
            border-color: var(--border);
            color: var(--text);
        }

        .table {
            color: var(--text);
        }

        .table thead th {
            border-bottom: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .table td,
        .table th {
            border-top: 1px solid var(--border);
            vertical-align: middle;
        }

        .form-control,
        .custom-select,
        textarea.form-control {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            color: var(--text);
        }

        .form-control:focus,
        .custom-select:focus,
        textarea.form-control:focus {
            border-color: rgba(var(--accent-rgb), 0.5);
            box-shadow: 0 0 0 0.2rem rgba(var(--accent-rgb), 0.14);
            background: var(--bg-elevated);
            color: var(--text);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .alert {
            border: 1px solid var(--border);
            background: var(--bg-elevated);
            color: var(--text);
        }

        .main-footer {
            border-top: 1px solid var(--border);
            background: transparent;
            color: var(--text-muted);
        }

        .badge.bg-success,
        .badge.badge-success {
            background-color: rgba(42, 157, 98, 0.18) !important;
            color: var(--success) !important;
            border: 1px solid rgba(42, 157, 98, 0.34);
        }

        .badge.bg-warning,
        .badge.badge-warning {
            background-color: rgba(208, 138, 46, 0.18) !important;
            color: var(--warning) !important;
            border: 1px solid rgba(208, 138, 46, 0.34);
        }

        .badge.bg-danger,
        .badge.badge-danger {
            background-color: rgba(215, 68, 78, 0.18) !important;
            color: var(--danger) !important;
            border: 1px solid rgba(215, 68, 78, 0.34);
        }

        .badge.bg-secondary,
        .badge.badge-secondary {
            background-color: rgba(127, 139, 160, 0.18) !important;
            color: var(--text-muted) !important;
            border: 1px solid rgba(127, 139, 160, 0.34);
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
            <span class="brand-text">Mielno Admin</span>
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
        <strong>Mielno</strong> <span class="text-muted">| panel administracyjny</span>
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
