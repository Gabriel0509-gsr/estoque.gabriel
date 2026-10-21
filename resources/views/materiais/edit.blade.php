@extends('layout_principal.principal')

@section('title', 'Alterar produto | estoque edu')

@section('content')
    <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-sm">
        <div class="card-body p-4">
            <h1 class="h2 fw-bold mb-4">Alterar produto</h1>
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ route('materiais.update', $material) }}" class="row g-3">
                @csrf
                @method('PUT')
                @foreach (['nome' => 'Nome', 'descricao' => 'Descrição', 'categoria' => 'Categoria', 'quantidade' => 'Quantidade', 'estoque_minimo' => 'Estoque mínimo', 'localizacao' => 'Localização', 'estado_conservacao' => 'Estado de conservação'] as $campo => $rotulo)
                    <div class="col-md-6">
                        <label for="{{ $campo }}" class="form-label">{{ $rotulo }}</label>
                        <input id="{{ $campo }}" name="{{ $campo }}" type="{{ in_array($campo, ['quantidade', 'estoque_minimo'], true) ? 'number' : 'text' }}" class="form-control @error($campo) is-invalid @enderror" value="{{ old($campo, $material->{$campo}) }}" @if (in_array($campo, ['quantidade', 'estoque_minimo'], true)) min="0" step="1" @endif required>
                        @error($campo)<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                @endforeach
                <div class="col-12 d-flex gap-2">
                    <a href="{{ route('tabela_materiais') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Salvar alterações</button>
                </div>
            </form>
        </div>
    </section>
@endsection
