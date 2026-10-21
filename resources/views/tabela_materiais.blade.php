@extends('layout_principal.principal')

@section('title', 'Materiais | estoque edu')

@section('content')
    <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-sm">
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="h2 fw-bold mb-1">Materiais cadastrados</h1>
                    <p class="text-secondary mb-0">Consulte os itens registrados.</p>
                </div>
                <a href="{{ route('cadastro_materiais') }}" class="btn btn-danger">Cadastrar material</a>
            </div>
            @if ($materiais->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead><tr><th>Material</th><th>Categoria</th><th>Quantidade</th><th>Estoque mínimo</th><th>Localização</th><th>Conservação</th><th>Ações</th></tr></thead>
                        <tbody>
                            @foreach ($materiais as $material)
                                <tr>
                                    <td>{{ $material->nome }}</td>
                                    <td>{{ $material->categoria }}</td>
                                    <td>{{ $material->quantidade }}</td>
                                    <td>{{ $material->estoque_minimo }}</td>
                                    <td>{{ $material->localizacao }}</td>
                                    <td>{{ $material->estado_conservacao }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ route('materiais.show', $material) }}" class="btn btn-sm btn-outline-primary">Visualizar</a>
                                            <a href="{{ route('materiais.edit', $material) }}" class="btn btn-sm btn-outline-warning">Alterar</a>
                                            <form method="POST" action="{{ route('materiais.destroy', $material) }}" onsubmit="return confirm('Deseja realmente excluir este produto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Deletar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-info mb-0">Ainda não há materiais cadastrados.</p>
            @endif
        </div>
    </section>
@endsection
