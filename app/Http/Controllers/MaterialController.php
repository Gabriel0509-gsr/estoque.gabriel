<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'estoque_minimo' => ['required', 'integer', 'min:0'],
            'localizacao' => ['required', 'string', 'max:255'],
            'estado_conservacao' => ['required', 'string', 'max:255'],
        ], [
            'required' => 'Preencha este campo.',
            'max' => 'Este campo deve ter no máximo :max caracteres.',
            'integer' => 'Informe um número inteiro.',
            'min' => 'O valor não pode ser negativo.',
        ]);

        Material::create($dados);

        return redirect()
            ->route('tabela_materiais')
            ->with('success', 'Produto cadastrado com sucesso.');
    }
}
