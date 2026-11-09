<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FornecedorController extends Controller
{
    public function Fornecedor(Request $request): View
    {
        return view('cadastro_fornecedor', [
            'fornecedores' => Fornecedor::query()->orderBy('nome')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:255', 'unique:fornecedor,cnpj'],
            'telefone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:fornecedor,email'],
        ]);

        Fornecedor::create($dados);

        return redirect()->route('cadastro_fornecedor')->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    public function salvar_fornecedor(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:255|unique:fornecedor',
            'telefone' => 'required|string|',
            'email' => 'required|string|email|max:255|unique:fornecedor',
        ]);

        try {
            $fornecedor = new Fornecedor;
            $fornecedor->nome = $request->nome;
            $fornecedor->cnpj = $request->cnpj;
            $fornecedor->telefone = $request->telefone;
            $fornecedor->email = $request->email;

            $fornecedor->save();

            return response()->json(['message' => 'Fornecedor cadastrado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao cadastrar fornecedor!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }

    public function ver_fornecedor(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $fornecedor = Fornecedor::find($request->id);

        if ($fornecedor) {
            return response()->json(['fornecedor' => $fornecedor, 'erro' => 'n'], 200);
        }

        return response()->json(['message' => 'Fornecedor não encontrado!', 'erro' => 's'], 200);
    }

    public function listar_fornecedores(Request $request)
    {
        $fornecedores = Fornecedor::all();

        return response()->json(['fornecedor' => $fornecedores], 200);
    }

    public function listar_fornecedores_simples(Request $request)
    {
        $fornecedores = Fornecedor::select('nome', 'email')->get();

        return response()->json(['fornecedor' => $fornecedores], 200);
    }

    public function alterar_fornecedor(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:fornecedor,id',
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:255',
            'telefone' => 'required|string|',
            'email' => 'required|string|email|max:255|',
        ]);

        try {
            $fornecedor = Fornecedor::find($request->id);

            if ($fornecedor->email != $request->cnpj) {
                $fornecedor_email_igual = Fornecedor::where('email', $request->email)->first();
                if ($fornecedor_email_igual) {
                    return response()->json(['message' => 'Email já cadastrado!', 'erro' => 's'], 200);
                }
            }

            $fornecedor->nome = $request->nome;
            $fornecedor->cnpj = $request->cnpj;
            $fornecedor->telefone = $request->telefone;
            $fornecedor->email = $request->email;
            $fornecedor->save();

            return response()->json(['message' => 'Fornecedor alterado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao alterar fornecedor!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }

    public function deletar_fornecedor(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:fornecedor,id',
        ]);

        try {
            $fornecedor = Fornecedor::find($request->id);
            $fornecedor->delete();

            return response()->json(['message' => 'Fornecedor deletado com sucesso!', 'erro' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao deletar fornecedor!', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }
    }
}
