<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UsuarioController;
use App\Models\Material;

Route::view('/', 'home_site')->name('home');
Route::view('/sobre', 'sobre_site')->name('sobre');
Route::view('/contato', 'contato_site')->name('contato');
Route::view('/cadastro_materiais', 'cadastro_materiais')->name('cadastro_materiais');
Route::post('/cadastro_materiais', [MaterialController::class, 'store'])->name('materiais.store');
Route::get('/tabela_materiais', function (Request $request) {
    $busca = trim($request->query('busca', ''));

    $materiais = Material::query()
        ->when($busca, function ($query, $busca) {
            $query->where(function ($query) use ($busca) {
                $query->where('nome', 'like', "%{$busca}%")
                    ->orWhere('descricao', 'like', "%{$busca}%")
                    ->orWhere('categoria', 'like', "%{$busca}%")
                    ->orWhere('localizacao', 'like', "%{$busca}%")
                    ->orWhere('estado_conservacao', 'like', "%{$busca}%");
            });
        })
        ->orderBy('nome')
        ->paginate(10)
        ->withQueryString();

    return view('tabela_materiais', compact('materiais', 'busca'));
})->name('tabela_materiais');
Route::view('/login', 'login_site')->name('login');

Route::get('/cadastro_usuario', [UsuarioController::class, 'cadastro_html'])->name('cadastro_usuario');
Route::post('/cadastro_usuario', [UsuarioController::class, 'store'])->name('usuarios.store');
