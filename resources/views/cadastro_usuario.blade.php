@extends('layout.principal')

@section('title', 'Cadastro de usuário | SEME')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, .96);" aria-labelledby="titulo-cadastro">
                <div class="card-body p-4">
                    <h1 class="card-title fw-bold mb-1" id="titulo-cadastro">Cadastre-se</h1>
                    <p class="text-secondary mb-4">Preencha seus dados para criar sua conta.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Não foi possível concluir o cadastro:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome completo</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" maxlength="255" placeholder="Seu nome completo" autocomplete="name" required>
                            @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" maxlength="255" placeholder="seu@email.com" autocomplete="email" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cpf" class="form-label fw-semibold">CPF</label>
                                <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf') }}" maxlength="11" placeholder="Somente números" inputmode="numeric">
                                @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data_nascimento" class="form-label fw-semibold">Data de nascimento</label>
                                <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}" autocomplete="bday">
                                @error('data_nascimento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label fw-semibold">Senha</label>
                            <input type="password" class="form-control @error('senha') is-invalid @enderror" id="senha" name="senha" placeholder="Pelo menos 8 caracteres" autocomplete="new-password" required>
                            @error('senha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="confirmar_senha" class="form-label fw-semibold">Confirmar senha</label>
                            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" placeholder="Digite sua senha novamente" autocomplete="new-password" required>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold">Cadastrar usuário</button>
                        <p class="text-center text-secondary mt-3 mb-0">
                            Já tem uma conta?
                            <a href="{{ route('login') }}" class="link-danger fw-semibold text-decoration-none">Faça login</a>
                        </p>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
