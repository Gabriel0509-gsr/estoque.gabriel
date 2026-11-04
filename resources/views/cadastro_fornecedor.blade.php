<<<<<<< HEAD
@extends('layout_principal.principal')

@section('title', 'Cadastro de fornecedores | estoque edu')

@section('content')
    <div class="row justify-content-center py-3 py-lg-4">
        <div class="col-12 col-xl-9">
            <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h2 fw-bold mb-2">Cadastrar fornecedor</h1>
                    <p class="text-secondary mb-4">Cadastre um fornecedor para mantê-lo disponível no sistema.</p>

                    @if (session('success'))
                        <div class="alert alert-success" role="status">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('fornecedores.store') }}" class="row g-3">
                        @csrf
                        <div class="col-12 col-md-6">
                            <label for="nome" class="form-label fw-semibold">Nome ou razão social</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" maxlength="255" required>
                            @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="cnpj" class="form-label fw-semibold">CNPJ</label>
                            <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" maxlength="255" autocomplete="off" required>
                            @error('cnpj')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="telefone" class="form-label fw-semibold">Telefone</label>
                            <input type="tel" class="form-control @error('telefone') is-invalid @enderror" id="telefone" name="telefone" value="{{ old('telefone') }}" maxlength="255" autocomplete="tel" required>
                            @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" maxlength="255" autocomplete="email" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger px-4">Cadastrar fornecedor</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <section class="card border-0 rounded-4 shadow-sm mt-4">
        <div class="card-body p-4">
            <h2 class="h4 fw-bold mb-3">Fornecedores cadastrados</h2>
            @if ($fornecedores->isEmpty())
                <p class="alert alert-info mb-0">Nenhum fornecedor cadastrado ainda.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr><th scope="col">Nome</th><th scope="col">CNPJ</th><th scope="col">Telefone</th><th scope="col">E-mail</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($fornecedores as $fornecedor)
                                <tr>
                                    <td>{{ $fornecedor->nome }}</td>
                                    <td>{{ $fornecedor->cnpj }}</td>
                                    <td>{{ $fornecedor->telefone }}</td>
                                    <td>{{ $fornecedor->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
@endsection
=======
<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>
>>>>>>> origin/main
