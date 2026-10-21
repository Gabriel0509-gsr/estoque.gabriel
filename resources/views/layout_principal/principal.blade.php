<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'estoque edu')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>body { min-height: 100vh; background-color: #d8d0c5; background-image: linear-gradient(rgba(255, 255, 255, .08), rgba(255, 255, 255, .08)), url("/imagem%20132.png"); background-position: center; background-size: cover; background-attachment: fixed; background-repeat: no-repeat; } .navbar-brand { color: #b02a37; font-weight: 700; }
        .profile-card { display: flex; align-items: center; gap: .65rem; max-width: 100%; padding: .3rem .4rem .3rem .35rem; border: 1px solid #e9ecef; border-radius: 999px; background: #fff; box-shadow: 0 .15rem .5rem rgba(33, 37, 41, .06); }
        .profile-avatar { display: grid; width: 2.35rem; height: 2.35rem; flex: 0 0 2.35rem; place-items: center; border-radius: 50%; background: linear-gradient(135deg, #dc3545, #842029); color: #fff; font-size: 1rem; font-weight: 700; }
        .profile-copy { display: flex; min-width: 0; flex-direction: column; line-height: 1.15; text-align: left; }
        .profile-eyebrow { color: #6c757d; font-size: .62rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; }
        .profile-name { max-width: 9rem; overflow: hidden; color: #212529; font-size: .82rem; font-weight: 600; text-overflow: ellipsis; white-space: nowrap; }
        .profile-logout { display: inline-flex; width: 2.2rem; height: 2.2rem; align-items: center; justify-content: center; border: 0; border-radius: 50%; background: #fff1f2; color: #b02a37; transition: background-color .15s ease, color .15s ease; }
        .profile-logout:hover, .profile-logout:focus-visible { background: #b02a37; color: #fff; }
        @media (max-width: 575.98px) { .profile-copy { display: none; } }</style>
</head>
<body>
    <header class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">estoque edu</a>
            <nav class="d-flex flex-wrap align-items-center gap-3" aria-label="Navegação principal">
                <a class="link-secondary text-decoration-none" href="{{ route('home') }}">Início</a>
                <a class="link-secondary text-decoration-none" href="{{ route('sobre') }}">Sobre</a>
                <a class="link-secondary text-decoration-none" href="{{ route('contato') }}">Contato</a>
                <a class="link-secondary text-decoration-none" href="{{ route('cadastro_materiais') }}">Cadastrar materiais</a>
                <a class="link-secondary text-decoration-none" href="{{ route('tabela_materiais') }}">Tabela de materiais</a>
                <a class="link-secondary text-decoration-none" href="{{ route('cadastro_fornecedor') }}">Fornecedores</a>
                <a class="link-secondary text-decoration-none" href="{{ route('entregas.index') }}">Entregas</a>
                <a class="link-secondary text-decoration-none" href="{{ route('movimentacoes.index') }}">Movimentações</a>
                @if (session('usuario_logado'))
                    <div class="profile-card" aria-label="Perfil conectado">
                        <div class="profile-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr((string) session('usuario_logado'), 0, 1)) }}</div>
                        <div class="profile-copy">
                            <span class="profile-eyebrow">Sessão ativa</span>
                            <span class="profile-name" title="{{ session('usuario_logado') }}">{{ session('usuario_logado') }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button class="profile-logout" type="submit" aria-label="Sair da conta" title="Sair da conta">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M10 17l5-5-5-5M15 12H3m9-8h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a class="btn btn-sm btn-outline-danger" href="{{ route('login') }}">Entrar</a>
                @endif
            </nav>
        </div>
    </header>
    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
