<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function cadastro_html(): View
    {
        return view('cadastro_usuario');
    }

    public function forgotPassword(): View
    {
        return view('recuperar_senha');
    }

    public function login(): View
    {
        return view('login_site');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required', 'string'],
        ]);

        $usuario = Usuario::query()->where('email', $dados['email'])->first();

        if (! $usuario || ! Hash::check($dados['senha'], $usuario->senha)) {
            return back()
                ->withErrors(['email' => 'E-mail ou senha inválidos.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put([
            'usuario_id' => $usuario->id,
            'usuario_logado' => $usuario->nome,
        ]);

        return redirect()->route('home');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function salvar_usuario(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuario',
            'senha' => 'required|string|',
            'tipo_usuario' => 'required|string',
            'cpf' => 'required|string|max:14|unique:usuario',
            'data_nascimento' => 'required|date',

        ]);

        try {
            $usuario = new Usuario;
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->senha = Hash::make($request->senha);
            $usuario->tipo_usuario = $request->tipo_usuario;
            $usuario->cpf = $request->cpf;
            $usuario->data_nascimento = $request->data_nascimento;

            $usuario->save();

            return response()->json(['message' => 'Usuário cadastrado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao cadastrar usuário!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }

    public function ver_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
        $usuario = Usuario::find($request->id);
        if ($usuario) {
            return response()->json(['usuario' => $usuario, 'erro' => 'n'], 200);
        } else {
            return response()->json(['message' => 'Usuário não encontrado!', 'erro' => 's'], 200);
        }
    }

    public function listar_usuarios(Request $request)
    {
        $usuarios = Usuario::all();

        return response()->json(['usuarios' => $usuarios], 200);
    }

    public function listar_usuarios_simples(Request $request)
    {
        $usuarios = Usuario::select('nome', 'email')->get();

        return response()->json(['usuarios' => $usuarios], 200);
    }

    public function alterar_usuario(Request $request)
    {

        $request->validate([
            'id' => 'required|integer|exists:usuario,id',
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'senha' => 'required|string|',
            'tipo_usuario' => 'required|string',
            'cpf' => 'required|string|max:14',
            'data_nascimento' => 'required|date',
        ]);

        try {

            $usuario = Usuario::find($request->id);

            if ($usuario->email != $request->cpf) {
                $usuario_email_igual = Usuario::where('email', $request->email)->first();
                if ($usuario_email_igual) {
                    return response()->json(['message' => 'Email já cadastrado!', 'erro' => 's'], 200);
                }
            }
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->senha = Hash::make($request->senha);
            $usuario->tipo_usuario = $request->tipo_usuario;
            $usuario->cpf = $request->cpf;
            $usuario->data_nascimento = $request->data_nascimento;

            $usuario->save();

            return response()->json(['message' => 'Usuário alterado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao alterar usuário!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }

    public function deletar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id',
        ]);

        try {
            $usuario = Usuario::find($request->id);
            $usuario->delete();

            return response()->json(['message' => 'Usuário deletado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao deletar usuário!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }
}
