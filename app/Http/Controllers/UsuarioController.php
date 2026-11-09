<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioToken;
use Illuminate\Http\JsonResponse;
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
        return view('login_aula');
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

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        return redirect()->route('login')->with('success', 'Solicitação de recuperação recebida.');
    }

    public function store(Request $request): RedirectResponse
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

        return redirect()->route('login')->with('success', 'Conta criada com sucesso. Faça login para continuar.');
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

            $usuarioToken = new UsuarioToken;
            $usuarioToken->usuario_id = $usuario->id;
            $usuarioToken->token = Hash::make($usuario->id.$usuario->email.now());
            $usuarioToken->valido_ate = now()->addDays(7);
            $usuarioToken->save();

            return response()->json([
                'usuario' => $usuario->only([
                    'id',
                    'nome',
                    'email',
                    'tipo_usuario',
                    'cpf',
                    'data_nascimento',
                ]),
                'token' => $usuarioToken->token,
                'erro' => 'n',
            ], 200);
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
        }

        return response()->json(['message' => 'Usuário não encontrado!', 'erro' => 's'], 200);
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

            if ($usuario->email !== $request->email) {
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

    public function loginApi(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required',
            'senha' => 'required',
        ]);

        $usuario = Usuario::where('email', '=', $request->email)->first();

        if ($usuario && Hash::check($request->senha, $usuario->senha)) {
            $usuarioToken = new UsuarioToken;
            $usuarioToken->usuario_id = $usuario->id;
            $usuarioToken->token = Hash::make($usuario->id.$usuario->email.now());
            $usuarioToken->valido_ate = now()->addDays(7);
            $usuarioToken->save();

            return response()->json(['message' => 'Login realizado com sucesso!', 'erro' => 'n', 'token' => $usuarioToken->token], 200);
        }

        if ($usuario) {
            return response()->json(['message' => 'Usuario ou senha incorretos!', 'erro' => 's'], 200);
        }

        return response()->json(['message' => 'Email não encontrado!', 'erro' => 's'], 200);
    }

    public function logoutApi(Request $request): JsonResponse
    {
        $request->validate([
            'usuario_id' => 'required',
            'token' => 'required',
        ]);

        $usuarioToken = UsuarioToken::where('token', '=', $request->token)->first();

        if ($usuarioToken) {
            $usuarioToken->delete();

            return response()->json(['message' => 'Logout realizado com sucesso!', 'erro' => 'n'], 200);
        }

        return response()->json(['message' => 'Token inválido!', 'erro' => 's'], 200);
    }
}
