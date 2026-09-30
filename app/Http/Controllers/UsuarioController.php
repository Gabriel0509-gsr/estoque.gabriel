<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function cadastro_html(Request $request) 
    {
        return view('cadastro_usuario'); 
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:usuario,email'],
            'cpf' => ['nullable', 'digits:11'],
            'data_nascimento' => ['nullable', 'date', 'before_or_equal:today'],
            'senha' => ['required', 'string', 'min:8', 'same:confirmar_senha'],
            'confirmar_senha' => ['required', 'string'],
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cpf.digits' => 'O CPF deve conter exatamente 11 números.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser futura.',
            'senha.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'senha.same' => 'A confirmação da senha não confere.',
        ]);

        Usuario::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'cpf' => $dados['cpf'] ?? null,
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'senha' => Hash::make($dados['senha']),
            'tipo_usuario' => 1,
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Conta criada com sucesso. Faça login para continuar.');
    }
}
