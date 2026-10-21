<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(): View
    {
        return view('tabela_materiais', [
            'materiais' => Material::query()->orderBy('nome')->get(),
        ]);
    }

    public function show(Material $material): View
    {
        return view('materiais.show', compact('material'));
    }

    public function edit(Material $material): View
    {
        return view('materiais.edit', compact('material'));
    }

    public function update(Request $request, Material $material): RedirectResponse
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'estoque_minimo' => ['required', 'integer', 'min:0'],
            'localizacao' => ['required', 'string', 'max:255'],
            'estado_conservacao' => ['required', 'string', 'max:255'],
        ]);

        $material->update($dados);

        return redirect()->route('materiais.show', $material)->with('success', 'Material atualizado com sucesso.');
    }

    public function destroy(Material $material): RedirectResponse
    {
        $material->delete();

        return redirect()->route('tabela_materiais')->with('success', 'Material excluído com sucesso.');
    }

    public function salvar_material(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'estoque_minimo' => 'required|integer|min:0',
            'localizacao' => 'required|string|max:255',
            'estado_conservacao' => 'required|string|max:255',
        ]);

        try {
            $material = new Material;
            $material->nome = $request->nome;
            $material->descricao = $request->descricao;
            $material->categoria = $request->categoria;
            $material->quantidade = $request->quantidade;
            $material->estoque_minimo = $request->estoque_minimo;
            $material->localizacao = $request->localizacao;
            $material->estado_conservacao = $request->estado_conservacao;

            $material->save();

            return response()->json(['message' => 'Material cadastrado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao cadastrar material!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }

    public function ver_material(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
        $material = Material::find($request->id);
        if ($material) {
            return response()->json(['material' => $material, 'erro' => 'n'], 200);
        } else {
            return response()->json(['message' => 'Material não encontrado!', 'erro' => 's'], 200);
        }
    }

    public function listar_materiais(Request $request)
    {
        $materiais = Material::all();

        return response()->json(['materiais' => $materiais], 200);
    }

    public function listar_materiais_simples(Request $request)
    {
        $materiais = Material::select('nome', 'descricao')->get();

        return response()->json(['materiais' => $materiais], 200);
    }

    public function alterar_material(Request $request)
    {

        $request->validate([
            'id' => 'required|integer|exists:material,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'estoque_minimo' => 'required|integer|min:0',
            'localizacao' => 'required|string|max:255',
            'estado_conservacao' => 'required|string|max:255',
        ]);

        try {

            $material = Material::find($request->id);

            if ($material->email != $request->cpf) {
                $material_email_igual = Material::where('email', $request->email)->first();
                if ($material_email_igual) {
                    return response()->json(['message' => 'Email já cadastrado!', 'erro' => 's'], 200);
                }
            }
            $material->nome = $request->nome;
            $material->descricao = $request->descricao;
            $material->categoria = $request->categoria;
            $material->quantidade = $request->quantidade;
            $material->estoque_minimo = $request->estoque_minimo;
            $material->localizacao = $request->localizacao;
            $material->estado_conservacao = $request->estado_conservacao;

            $material->save();

            return response()->json(['message' => 'Material alterado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao alterar material!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }

    public function deletar_material(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:material,id']);

        try {

            $material = Material::find($request->id);
            $material->delete();

            return response()->json(['message' => 'Material deletado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao deletar material!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }

    }
}
