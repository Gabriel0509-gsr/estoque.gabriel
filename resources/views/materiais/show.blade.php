@extends('layout_principal.principal')

@section('title', 'Visualizar produto | estoque edu')

@section('content')
    <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-sm">
        <div class="card-body p-4">
            <h1 class="h2 fw-bold mb-4">{{ $material->nome }}</h1>
            <dl class="row">
                <dt class="col-sm-3">Descrição</dt><dd class="col-sm-9">{{ $material->descricao }}</dd>
                <dt class="col-sm-3">Categoria</dt><dd class="col-sm-9">{{ $material->categoria }}</dd>
                <dt class="col-sm-3">Quantidade</dt><dd class="col-sm-9">{{ $material->quantidade }}</dd>
                <dt class="col-sm-3">Estoque mínimo</dt><dd class="col-sm-9">{{ $material->estoque_minimo }}</dd>
                <dt class="col-sm-3">Localização</dt><dd class="col-sm-9">{{ $material->localizacao }}</dd>
                <dt class="col-sm-3">Conservação</dt><dd class="col-sm-9">{{ $material->estado_conservacao }}</dd>
            </dl>
            <a href="{{ route('tabela_materiais') }}" class="btn btn-outline-secondary">Voltar</a>
            <a href="{{ route('materiais.edit', $material) }}" class="btn btn-warning">Alterar produto</a>
        </div>
    </section>
@endsection
