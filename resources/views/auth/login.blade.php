<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie Admina - BookingMielno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: radial-gradient(circle at top left, #23445f, #0f172a 60%);
            color: #0f172a;
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border: 0;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.35);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(120deg, #0f3460, #1a1a2e);
            color: #fff;
            padding: 1.4rem 1.6rem;
        }

        .login-body {
            padding: 1.6rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h1 class="h4 mb-1">Panel Administratora</h1>
            <p class="mb-0 opacity-75">Zaloguj sie, aby zarzadzac rezerwacjami</p>
        </div>
        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Haslo</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Zapamietaj mnie
                    </label>
                </div>

                <button class="btn btn-primary w-100" type="submit">Zaloguj</button>
            </form>

            <a href="{{ route('home') }}" class="btn btn-link w-100 mt-2">Wroc na strone glowna</a>
        </div>
    </div>
</body>
</html>
