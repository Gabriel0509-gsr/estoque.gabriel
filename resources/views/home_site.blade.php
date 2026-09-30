@extends('layout.principal')

@section('title', 'Início | SEME')

@section('content')
    <style>
        .home-hero {
            position: relative;
            overflow: hidden;
            border: 0;
            border-top: 5px solid #dc3545;
            border-radius: 1.25rem;
            background: rgba(255, 255, 255, .94);
        }

        .home-hero::after {
            position: absolute;
            right: -4rem;
            bottom: -7rem;
            width: 19rem;
            height: 19rem;
            border-radius: 50%;
            background: rgba(220, 53, 69, .08);
            content: "";
        }

        .home-feature {
            height: 100%;
            border: 1px solid rgba(255, 255, 255, .65);
            background: rgba(255, 255, 255, .92);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .home-feature:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, .16) !important;
        }

        .home-feature-icon {
            display: inline-grid;
            width: 3rem;
            height: 3rem;
            place-items: center;
            border-radius: 1rem;
            color: #dc3545;
            background: rgba(220, 53, 69, .1);
        }
    </style>

    <div class="container py-3 py-lg-4">
        <section class="home-hero shadow-lg mb-4" id="home">
            <div class="card-body position-relative p-4 p-md-5" style="z-index: 1;">
                <span class="badge rounded-pill text-bg-danger mb-3">SEME · Gestão escolar</span>
                <h1 class="display-5 fw-bold mb-3">Materiais escolares sempre em ordem.</h1>
                <p class="lead text-secondary mb-4" style="max-width: 48rem;">
                    Um espaço simples para organizar materiais, acompanhar fornecedores e manter tudo o que sua escola precisa em um só lugar.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="{{ route('cadastro_usuario') }}" class="btn btn-danger btn-lg px-4">Começar agora</a>
                    <a href="{{ route('sobre') }}" class="btn btn-outline-secondary btn-lg px-4">Conheça o sistema</a>
                </div>
            </div>
        </section>

        <section class="row g-3 g-lg-4" id="sobre" aria-label="Recursos do sistema">
            <div class="col-md-4">
                <article class="card home-feature rounded-4 shadow-sm">
                    <div class="card-body p-4">
                        <span class="home-feature-icon mb-3" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 5.5A1.5 1.5 0 0 1 5.5 4H20v14H5.5A1.5 1.5 0 0 0 4 19.5v-14Z" stroke="currentColor" stroke-width="1.8"/><path d="M4 19.5A1.5 1.5 0 0 1 5.5 18H20M8 8h8M8 11h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </span>
                        <h2 class="h5 fw-bold">Materiais organizados</h2>
                        <p class="text-secondary mb-0">Consulte os materiais da escola e tenha as informações importantes sempre à mão.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-4" id="materiais">
                <article class="card home-feature rounded-4 shadow-sm">
                    <div class="card-body p-4">
                        <span class="home-feature-icon mb-3" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3.5 7.5 12 3l8.5 4.5L12 12 3.5 7.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M3.5 12 12 16.5l8.5-4.5M3.5 16.5 12 21l8.5-4.5" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                        </span>
                        <h2 class="h5 fw-bold">Controle de estoque</h2>
                        <p class="text-secondary mb-0">Acompanhe os itens disponíveis e facilite o planejamento das necessidades escolares.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-4" id="contato">
                <article class="card home-feature rounded-4 shadow-sm">
                    <div class="card-body p-4">
                        <span class="home-feature-icon mb-3" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m4.5 7 7.5 6 7.5-6" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                        </span>
                        <h2 class="h5 fw-bold">Fornecedores</h2>
                        <p class="text-secondary mb-0">Mantenha os dados dos fornecedores centralizados para consultar quando precisar.</p>
                    </div>
                </article>
            </div>
        </section>
    </div>
@endsection
