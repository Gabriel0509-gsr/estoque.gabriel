@extends('layout_principal.principal')

@section('title', 'Recuperar senha | estoque edu')

@section('content')
    <div class="row justify-content-center py-3 py-lg-4">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">
            <section class="card border-0 border-top border-4 border-danger rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, .96);" aria-labelledby="titulo-recuperar-senha">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="h3 fw-bold mb-2" id="titulo-recuperar-senha">Recuperar senha</h1>
                    <p class="text-secondary mb-4">Informe o e-mail da sua conta e escolha uma nova senha.</p>

                    <div class="alert alert-info" role="note">Informe o mesmo e-mail usado no cadastro. A nova senha deve ter pelo menos 8 caracteres e coincidir com a confirmação.</div>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail cadastrado</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label fw-semibold">Nova senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" minlength="8" autocomplete="new-password" required>
                        </div>

                        <div class="mb-4">
                            <label for="confirmar_senha" class="form-label fw-semibold">Confirme a nova senha</label>
                            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" minlength="8" autocomplete="new-password" required>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold">Atualizar senha</button>
                    </form>

                    <p class="text-center mt-4 mb-0">
                        <a href="{{ route('login') }}" class="link-danger text-decoration-none">Voltar para o login</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
@endsection
