@extends('layout_principal.principal')

@section('title', 'Entregas | estoque edu')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning" role="alert">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <p class="fw-semibold mb-2">Confira os dados informados:</p>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <h1 class="h2 fw-bold">Registrar material recebido</h1>
                <p class="text-secondary">Informe o fornecedor, o material e a quantidade recebida.</p>

                @if ($fornecedores->isEmpty() || $materiais->isEmpty())
                    <div class="alert alert-info mb-0">
                        Cadastre ao menos um fornecedor e um material antes de registrar uma entrega.
                    </div>
                @else
                    <form method="POST" action="{{ route('entregas.store') }}" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <label class="form-label" for="fornecedor_id">Fornecedor</label>
                            <select class="form-select" id="fornecedor_id" name="fornecedor_id" required>
                                <option value="">Selecione um fornecedor</option>
                                @foreach ($fornecedores as $fornecedor)
                                    <option value="{{ $fornecedor->id }}" @selected(old('fornecedor_id') == $fornecedor->id)>
                                        {{ $fornecedor->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="material_id">Material</label>
                            <select class="form-select" id="material_id" name="material_id" required>
                                <option value="">Selecione um material</option>
                                @foreach ($materiais as $material)
                                    <option value="{{ $material->id }}" @selected(old('material_id') == $material->id)>
                                        {{ $material->nome }} (estoque: {{ $material->quantidade }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="data_movimentacao">Data do recebimento</label>
                            <input class="form-control" type="date" id="data_movimentacao" name="data_movimentacao"
                                value="{{ old('data_movimentacao', now()->toDateString()) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="quantidade">Quantidade recebida</label>
                            <input class="form-control" type="number" min="1" step="1" id="quantidade"
                                name="quantidade" value="{{ old('quantidade') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="observacao">Observação</label>
                            <textarea class="form-control" id="observacao" name="observacao" rows="3" maxlength="255">{{ old('observacao') }}</textarea>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-danger" type="submit">Registrar recebimento</button>
                        </div>
                    </form>
                @endif
            </div>
        </section>

        <section class="card border-0 rounded-4 shadow-sm mt-4">
            <div class="card-body p-4">
                <h2 class="h4 fw-bold">Recebimentos recentes</h2>

                @if ($entregas->isEmpty())
                    <p class="text-secondary mb-0">Nenhum recebimento registrado.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Fornecedor</th>
                                    <th>Material</th>
                                    <th>Quantidade</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entregas as $entrega)
                                    <tr>
                                        <td>{{ \Illuminate\Support\Carbon::parse($entrega->data_movimentacao)->format('d/m/Y') }}</td>
                                        <td>{{ $entrega->fornecedor?->nome ?? 'Fornecedor removido' }}</td>
                                        <td>{{ $entrega->material?->nome ?? 'Material removido' }}</td>
                                        <td>{{ $entrega->quantidade }}</td>
                                        <td>{{ $entrega->observacao ?: '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
