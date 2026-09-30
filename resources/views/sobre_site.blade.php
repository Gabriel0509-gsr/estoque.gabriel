@extends('layout.principal')

@section('title', 'Sobre | SEME')

@section('content')
    <div class="container py-3 py-lg-4">
        <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg mb-4" style="background-color: rgba(255, 255, 255, .95);">
            <div class="card-body p-4 p-md-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link-danger text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sobre</li>
                    </ol>
                </nav>

                <span class="badge rounded-pill text-bg-danger mb-3">Conheça o SEME</span>
                <h1 class="display-5 fw-bold mb-3">Organização que apoia a educação.</h1>
                <p class="lead text-secondary mb-0" style="max-width: 54rem;">
                    O SEME foi pensado para facilitar a gestão dos materiais escolares, reunindo em um só lugar informações sobre itens, estoque e fornecedores.
                </p>
            </div>
        </section>

        <section class="row g-3 g-lg-4" aria-label="Sobre o sistema SEME">
            <div class="col-md-6">
                <article class="card h-100 border-0 rounded-4 shadow-sm" style="background-color: rgba(255, 255, 255, .94);">
                    <div class="card-body p-4 p-lg-5">
                        <span class="badge rounded-pill text-bg-light border text-danger mb-3">Nossa proposta</span>
                        <h2 class="h3 fw-bold">Mais clareza no dia a dia</h2>
                        <p class="text-secondary mb-0">
                            A plataforma ajuda a manter os registros organizados e torna mais simples consultar os materiais disponíveis e planejar as necessidades da escola.
                        </p>
                    </div>
                </article>
            </div>
            <div class="col-md-6">
                <article class="card h-100 border-0 rounded-4 shadow-sm" style="background-color: rgba(255, 255, 255, .94);">
                    <div class="card-body p-4 p-lg-5">
                        <span class="badge rounded-pill text-bg-light border text-danger mb-3">Gestão integrada</span>
                        <h2 class="h3 fw-bold">Materiais e fornecedores conectados</h2>
                        <p class="text-secondary mb-0">
                            Com os dados centralizados, a equipe pode acompanhar melhor os recursos escolares e encontrar as informações necessárias com rapidez.
                        </p>
                    </div>
                </article>
            </div>
        </section>

        <div class="text-center mt-4">
            <a href="{{ route('cadastro_materiais') }}" class="btn btn-danger btn-lg px-4">Cadastro de materiais</a>
        </div>
    </div>
@endsection
