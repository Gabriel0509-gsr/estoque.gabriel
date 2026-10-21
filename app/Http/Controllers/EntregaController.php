<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Material;
use App\Models\Movimentacao;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EntregaController extends Controller
{
    public function index(): View
    {
        $fornecedores = Fornecedor::query()->orderBy('nome')->get();
        $materiais = Material::query()->orderBy('nome')->get();
        $entregas = Movimentacao::query()
            ->with(['fornecedor', 'material'])
            ->where('tipo', 'entrada')
            ->orderByDesc('data_movimentacao')
            ->orderByDesc('id')
            ->limit(10)
            ->get();

        return view('entregas.index', compact('fornecedores', 'materiais', 'entregas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $usuarioId = $request->session()->get('usuario_id');

        if (! $usuarioId || ! Usuario::query()->whereKey($usuarioId)->exists()) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Entre na sua conta para registrar uma entrega.',
            ]);
        }

        $dados = $request->validate([
            'fornecedor_id' => ['required', 'integer', 'exists:fornecedor,id'],
            'material_id' => ['required', 'integer', 'exists:material,id'],
            'data_movimentacao' => ['required', 'date'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'observacao' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($dados, $usuarioId): void {
            $material = Material::query()->lockForUpdate()->findOrFail($dados['material_id']);
            $material->increment('quantidade', $dados['quantidade']);

            Movimentacao::query()->create([
                'usuario_id' => $usuarioId,
                'material_id' => $material->id,
                'fornecedor_id' => $dados['fornecedor_id'],
                'tipo' => 'entrada',
                'quantidade' => (string) $dados['quantidade'],
                'data_movimentacao' => $dados['data_movimentacao'],
                'observacao' => $dados['observacao'] ?? '',
            ]);
        });

        return redirect()->route('entregas.index')->with('success', 'Entrega registrada e estoque atualizado.');
    }
}
