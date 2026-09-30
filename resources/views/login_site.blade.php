@extends('layout.principal')

@section('title', 'Entrar | SEME')

@section('content')
    <div class="row justify-content-center py-3 py-lg-4">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
            <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, .96);" aria-labelledby="titulo-login">
                <div class="card-body p-4 p-lg-5">
                    <span class="badge rounded-pill text-bg-danger mb-3">SEME · Gestão escolar</span>
                    <h1 class="card-title fw-bold mb-1" id="titulo-login">Bem-vindo de volta</h1>
                    <p class="text-secondary mb-4">Entre com seus dados para acessar sua conta.</p>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="seu@email.com" autocomplete="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label fw-semibold">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" autocomplete="current-password" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="lembrar">
                                <label class="form-check-label text-secondary" for="lembrar">Manter conectado</label>
                            </div>
                            <a href="#" class="link-danger small text-decoration-none">Esqueceu a senha?</a>
                        </div>

                        <a href="{{ route('cadastro_materiais') }}" class="btn btn-danger w-100 py-2 fw-semibold">Entrar</a>
                    </form>

                    <p class="text-center text-secondary mt-4 mb-0">
                        Ainda não tem uma conta?
                        <a href="{{ route('cadastro_usuario') }}" class="link-danger fw-semibold text-decoration-none">Cadastre-se</a>
                    </p>

                </div>
            </section>
        </div>
    </div>
@endsection
