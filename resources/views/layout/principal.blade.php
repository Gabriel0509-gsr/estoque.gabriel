<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SEME')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        body {
            min-height: 100vh;
            background-image: linear-gradient(rgba(15, 20, 29, .55), rgba(15, 20, 29, .55)), url('{{ asset('b.png') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .navbar-seme {
            min-height: 92px;
            border-bottom: 1px solid #ff1018;
            background-color: rgba(20, 20, 20, .2);
        }

        .navbar-seme .navbar-brand,
        .navbar-seme .nav-link {
            color: #ff1018;
            font-weight: 800;
            text-transform: uppercase;
        }

        .navbar-seme .navbar-brand {
            font-size: clamp(2.5rem, 5vw, 5.5rem);
            font-weight: 900;
            line-height: .9;
            letter-spacing: -4px;
        }

        .navbar-seme .nav-link { padding-inline: 1rem; font-size: 1.1rem; }
        .navbar-seme .nav-link:hover,
        .navbar-seme .nav-link:focus { color: #fff; }

        .account-link {
            display: grid;
            width: 48px;
            height: 48px;
            margin-left: 1rem;
            place-items: center;
            border-radius: 50%;
            color: #fff;
            background: #ff3842;
        }

        @media (max-width: 991.98px) {
            .navbar-seme .navbar-collapse { padding: 1rem 0; }
            .navbar-seme .nav-link { padding-left: 0; }
            .account-link { margin: .5rem 0 0; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-seme">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand" href="{{ url('/') }}">SEME</a>
            <button class="navbar-toggler border-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrincipal" aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarPrincipal">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('sobre') }}">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contato') }}">Contato</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cadastro_materiais') }}">Cadastro de materiais</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tabela_materiais') }}">Tabela de materiais</a></li>
                </ul>
                <a class="account-link" href="{{ route('login') }}" aria-label="Fazer login">
                    <svg width="27" height="27" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" />
                        <path d="M4 21c0-4.1 3.3-7 8-7s8 2.9 8 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <main class="container py-4 py-lg-5">
        @yield('content')
    </main>

</body>
</html>
