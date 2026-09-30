@extends('layout.principal')

@section('title', 'Contato | SEME')

@section('content')
    <div class="container py-3 py-lg-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, .95);">
                    <div class="card-body p-4 p-md-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb small mb-4">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link-danger text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contato</li>
                            </ol>
                        </nav>

                        <div class="row g-4 g-lg-5">
                            <div class="col-lg-5">
                                <span class="badge rounded-pill text-bg-danger mb-3">Fale com a gente</span>
                                <h1 class="display-6 fw-bold mb-3">Como podemos ajudar?</h1>
                                <p class="text-secondary mb-4">
                                    Envie sua dúvida ou sugestão sobre o SEME. Nossa equipe poderá ajudar com o uso do sistema e a gestão dos materiais escolares.
                                </p>

                                <div class="d-flex gap-3 align-items-start mb-3">
                                    <span class="badge rounded-circle text-bg-danger p-2" aria-hidden="true">1</span>
                                    <div>
                                        <h2 class="h6 fw-bold mb-1">Conte o que você precisa</h2>
                                        <p class="text-secondary small mb-0">Preencha o formulário com seus dados e sua mensagem.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-start">
                                    <span class="badge rounded-circle text-bg-danger p-2" aria-hidden="true">2</span>
                                    <div>
                                        <h2 class="h6 fw-bold mb-1">A mensagem será encaminhada</h2>
                                        <p class="text-secondary small mb-0">Inclua um e-mail válido para que possamos retornar.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <form>
                                    <div class="mb-3">
                                        <label for="nome" class="form-label fw-semibold">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" autocomplete="name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="seu@email.com" autocomplete="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="assunto" class="form-label fw-semibold">Assunto</label>
                                        <input type="text" class="form-control" id="assunto" name="assunto" placeholder="Sobre o que deseja falar?" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="mensagem" class="form-label fw-semibold">Mensagem</label>
                                        <textarea class="form-control" id="mensagem" name="mensagem" rows="5" placeholder="Escreva sua mensagem" required></textarea>
                                    </div>

                                    <button type="button" class="btn btn-danger w-100 py-2 fw-semibold">Enviar mensagem</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
