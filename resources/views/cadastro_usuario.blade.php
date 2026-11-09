@extends('layout_principal.principal')

@section('title', 'Cadastro de usuário | estoque edu')

@section('content')
    <div class="row justify-content-center py-3">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <h1 class="card-title fw-bold mb-1">Cadastre-se</h1>
                    <p class="text-secondary mb-4">Preencha seus dados para criar sua conta.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('usuarios.store') }}" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome completo</label>
                            <input id="nome" name="nome" type="text" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" maxlength="255" autocomplete="name" required>
                            @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" maxlength="255" autocomplete="email" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input id="cpf" name="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" value="{{ old('cpf') }}" maxlength="14" autocomplete="off" required>
                            @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label for="data_nascimento" class="form-label">Data de nascimento</label>
                            <input id="data_nascimento" name="data_nascimento" type="date" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento') }}" autocomplete="bday" required>
                            @error('data_nascimento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="senha" class="form-label">Senha</label>
                            <input id="senha" name="senha" type="password" class="form-control @error('senha') is-invalid @enderror" minlength="8" autocomplete="new-password" required>
                            @error('senha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="senha_confirmation" class="form-label">Confirmar senha</label>
                            <input id="senha_confirmation" name="senha_confirmation" type="password" class="form-control" minlength="8" autocomplete="new-password" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold">Cadastrar usuário</button>
                        </div>
                    </form>
                    <p class="text-center text-secondary mt-3 mb-0">Já tem uma conta? <a href="{{ route('login') }}" class="link-danger fw-semibold text-decoration-none">Faça login</a></p>
                </div>
            </section>
        </div>
    </div>
@endsection
