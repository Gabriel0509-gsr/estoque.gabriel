@extends('layout_principal.principal')

@section('title', 'Movimentações | estoque edu')

@section('content')
    <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-sm">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <span class="badge rounded-pill text-bg-danger mb-2">Controle de estoque</span>
                    <h1 class="h2 fw-bold mb-1">Movimentações de estoque</h1>
                    <p class="text-secondary mb-0">Consulte entradas e saídas registradas.</p>
                </div>
                <span class="badge text-bg-light border text-secondary fs-6">
                    {{ $movimentacoes->count() }} {{ $movimentacoes->count() === 1 ? 'registro' : 'registros' }}
                </span>
            </div>

            @if ($movimentacoes->isEmpty())
                <div class="alert alert-info mb-0" role="status">
                    Nenhuma movimentação foi registrada ainda.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Material</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Observação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movimentacoes as $movimentacao)
                                <tr>
                                    <td>{{ \Illuminate\Support\Carbon::parse($movimentacao->data_movimentacao)->format('d/m/Y') }}</td>
                                    <td>{{ $movimentacao->material?->nome ?? 'Material indisponível' }}</td>
                                    <td><span class="badge text-bg-secondary">{{ $movimentacao->tipo }}</span></td>
                                    <td>{{ $movimentacao->quantidade }}</td>
                                    <td>{{ $movimentacao->usuario?->nome ?? 'Usuário indisponível' }}</td>
                                    <td>{{ $movimentacao->observacao ?: '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
@endsection
