@extends('layout.principal')

@section('title', 'Cadastro de materiais | SEME')

@section('content')
    <div class="container py-3 py-lg-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, .96);" aria-labelledby="titulo-cadastro-material">
                    <div class="card-body p-4 p-md-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb small mb-4">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link-danger text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cadastro de materiais</li>
                            </ol>
                        </nav>

                        <span class="badge rounded-pill text-bg-danger mb-3">Estoque escolar</span>
                        <h1 class="fw-bold mb-1" id="titulo-cadastro-material">Cadastrar material</h1>
                        <p class="text-secondary mb-4">Preencha as informações para identificar e acompanhar o material.</p>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Confira os campos do formulário:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $erro)
                                        <li>{{ $erro }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('materiais.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="nome" class="form-label fw-semibold">Nome do produto</label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" maxlength="255" placeholder="Ex.: Caderno universitário" required>
                                    @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="categoria" class="form-label fw-semibold">Categoria</label>
                                    <input type="text" class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria" value="{{ old('categoria') }}" maxlength="255" placeholder="Ex.: Material escolar" required>
                                    @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label for="descricao" class="form-label fw-semibold">Descrição</label>
                                    <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="3" maxlength="255" placeholder="Detalhes ou especificações do produto" required>{{ old('descricao') }}</textarea>
                                    @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label for="quantidade" class="form-label fw-semibold">Quantidade em estoque</label>
                                    <input type="number" class="form-control @error('quantidade') is-invalid @enderror" id="quantidade" name="quantidade" value="{{ old('quantidade') }}" min="0" step="1" placeholder="0" required>
                                    @error('quantidade')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label for="estoque_minimo" class="form-label fw-semibold">Estoque mínimo</label>
                                    <input type="number" class="form-control @error('estoque_minimo') is-invalid @enderror" id="estoque_minimo" name="estoque_minimo" value="{{ old('estoque_minimo') }}" min="0" step="1" placeholder="0" required>
                                    @error('estoque_minimo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="localizacao" class="form-label fw-semibold">Localização</label>
                                    <input type="text" class="form-control @error('localizacao') is-invalid @enderror" id="localizacao" name="localizacao" value="{{ old('localizacao') }}" maxlength="255" placeholder="Ex.: Almoxarifado, prateleira A" required>
                                    @error('localizacao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="estado_conservacao" class="form-label fw-semibold">Estado de conservação</label>
                                    <input type="text" class="form-control @error('estado_conservacao') is-invalid @enderror" id="estado_conservacao" name="estado_conservacao" value="{{ old('estado_conservacao') }}" maxlength="255" placeholder="Ex.: Novo, bom, precisa de reparo" required>
                                    @error('estado_conservacao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                                <a href="{{ route('tabela_materiais') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
                                <button type="submit" class="btn btn-danger px-4 fw-semibold">Cadastrar produto</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
