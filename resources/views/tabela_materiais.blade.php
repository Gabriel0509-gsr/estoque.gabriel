@extends('layout.principal')

@section('title', 'Materiais em estoque | SEME')

@section('content')
    <style>
        .materials-panel {
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .7);
            border-top: 4px solid #dc3545;
            border-radius: 1rem;
            background: rgba(255, 255, 255, .96);
        }

        .materials-table thead th {
            padding: 1rem .85rem;
            background: #f3f4f6;
            color: #667085;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .materials-table tbody td { padding: 1rem .85rem; vertical-align: middle; }
        .materials-table tbody tr:last-child td { border-bottom: 0; }
        .stock-badge { min-width: 112px; }
    </style>

    <div class="container py-3 py-lg-4">
        <section class="materials-panel shadow-lg">
            <div class="p-4 p-lg-5 pb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link-danger text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tabela de materiais</li>
                    </ol>
                </nav>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
                    <div>
                        <span class="badge rounded-pill text-bg-danger mb-2">Estoque escolar</span>
                        <h1 class="h2 fw-bold mb-1">Materiais em estoque</h1>
                        <p class="text-secondary mb-0">Consulte e gerencie os materiais escolares e esportivos cadastrados.</p>
                    </div>
                    <a href="{{ route('cadastro_materiais') }}" class="btn btn-danger px-4 flex-shrink-0">
                        <span class="fs-5 me-1" aria-hidden="true">+</span> Adicionar produto
                    </a>
                </div>

                <form method="GET" action="{{ route('tabela_materiais') }}" class="row g-2 align-items-center mb-3">
                    <div class="col-12 col-md-8 col-lg-6">
                        <label for="busca" class="visually-hidden">Buscar materiais</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white text-secondary" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="2"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            </span>
                            <input type="search" class="form-control" id="busca" name="busca" value="{{ $busca }}" placeholder="Buscar por produto, descrição, categoria ou localização...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-danger">Buscar</button>
                    </div>
                    @if ($busca !== '')
                        <div class="col-auto">
                            <a href="{{ route('tabela_materiais') }}" class="btn btn-outline-secondary">Limpar</a>
                        </div>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 materials-table">
                    <thead>
                        <tr>
                            <th scope="col">Produto</th>
                            <th scope="col">Categoria</th>
                            <th scope="col" class="text-center">Quantidade</th>
                            <th scope="col" class="text-center">Estoque mínimo</th>
                            <th scope="col">Localização</th>
                            <th scope="col">Conservação</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materiais as $material)
                            <tr>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $material->nome }}</div>
                                    <div class="small text-secondary">{{ $material->descricao }}</div>
                                </td>
                                <td><span class="badge rounded-pill text-bg-primary bg-opacity-10 text-primary">{{ $material->categoria }}</span></td>
                                <td class="text-center fw-bold {{ $material->quantidade <= $material->estoque_minimo ? 'text-warning-emphasis' : 'text-dark' }}">{{ $material->quantidade }}</td>
                                <td class="text-center text-secondary">{{ $material->estoque_minimo }}</td>
                                <td>{{ $material->localizacao }}</td>
                                <td>{{ $material->estado_conservacao }}</td>
                                <td>
                                    @if ($material->quantidade <= $material->estoque_minimo)
                                        <span class="badge rounded-pill text-bg-warning stock-badge">Estoque baixo</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-success stock-badge">Em estoque</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <p class="fw-semibold mb-1">Nenhum material encontrado</p>
                                    <p class="text-secondary mb-3">@if ($busca !== '') Tente buscar por outro termo. @else Cadastre o primeiro produto para começar. @endif</p>
                                    @if ($busca === '')
                                        <a href="{{ route('cadastro_materiais') }}" class="btn btn-sm btn-danger">Cadastrar produto</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 p-3 px-lg-4 border-top">
                <span class="small text-secondary">
                    Exibindo {{ $materiais->firstItem() ?? 0 }}–{{ $materiais->lastItem() ?? 0 }} de {{ $materiais->total() }} materiais
                </span>
                <div>{{ $materiais->links('pagination::bootstrap-5') }}</div>
            </div>
        </section>
    </div>
@endsection
