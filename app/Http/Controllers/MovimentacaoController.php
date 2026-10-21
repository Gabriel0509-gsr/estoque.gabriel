<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function index()
    {
        $movimentacoes = Movimentacao::with(['usuario', 'material'])
            ->orderByDesc('data_movimentacao')
            ->orderByDesc('id')
            ->get();

        return view('movimentacoes.index', compact('movimentacoes'));
    }

    public function salvar_movimentacao(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'usuario_id' => ['required', 'integer', 'exists:usuario,id'],
            'material_id' => ['required', 'integer', 'exists:material,id'],
            'tipo' => ['required', 'string', 'max:255'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'data_movimentacao' => ['required', 'date'],
            'observacao' => ['nullable', 'string', 'max:255'],
        ]);

        $movimentacao = Movimentacao::create($dados);

        return response()->json([
            'message' => 'Movimentação cadastrada com sucesso.',
            'movimentacao' => $movimentacao,
        ], 201);
    }

    public function ver_movimentacao(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id' => ['required', 'integer', 'exists:movimentacao,id'],
        ]);

        return response()->json([
            'message' => 'Movimentação encontrada com sucesso.',
            'movimentacao' => Movimentacao::with(['usuario', 'material'])->findOrFail($dados['id']),
        ]);
    }

    public function listar_movimentacoes(Request $request): JsonResponse
    {
        return response()->json([
            'movimentacoes' => Movimentacao::with(['usuario', 'material'])->get(),
        ]);
    }

    public function listar_usuarios_simples(Request $request): JsonResponse
    {
        return response()->json([
            'usuarios' => Usuario::query()->get(['id', 'nome', 'email']),
        ]);
    }

    public function alterar_movimentacao(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id' => ['required', 'integer', 'exists:movimentacao,id'],
            'usuario_id' => ['required', 'integer', 'exists:usuario,id'],
            'material_id' => ['required', 'integer', 'exists:material,id'],
            'tipo' => ['required', 'string', 'max:255'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'data_movimentacao' => ['required', 'date'],
            'observacao' => ['nullable', 'string', 'max:255'],
        ]);

        $movimentacao = Movimentacao::findOrFail($dados['id']);
        $movimentacao->update($dados);

        return response()->json([
            'message' => 'Movimentação alterada com sucesso.',
            'movimentacao' => $movimentacao,
        ]);
    }

    public function deletar_movimentacao(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id' => ['required', 'integer', 'exists:movimentacao,id'],
        ]);

        Movimentacao::whereKey($dados['id'])->delete();

        return response()->json(['message' => 'Movimentação removida com sucesso.']);
    }
}
