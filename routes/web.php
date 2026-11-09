<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home_site')->name('home');
Route::view('/sobre', 'sobre_site')->name('sobre');
Route::view('/contato', 'contato_site')->name('contato');
Route::post('/contato', [ContatoController::class, 'store'])->middleware('throttle:5,1')->name('contato.store');

Route::view('/cadastro_materiais', 'cadastro_materiais')->name('cadastro_materiais');
Route::get('/tabela_materiais', [MaterialController::class, 'index'])->name('tabela_materiais');
Route::post('/cadastro_materiais', [MaterialController::class, 'salvar_material'])->name('materiais.store');
Route::get('/materiais/{material}', [MaterialController::class, 'show'])->name('materiais.show');
Route::get('/materiais/{material}/editar', [MaterialController::class, 'edit'])->name('materiais.edit');
Route::put('/materiais/{material}', [MaterialController::class, 'update'])->name('materiais.update');
Route::delete('/materiais/{material}', [MaterialController::class, 'destroy'])->name('materiais.destroy');

Route::get('/cadastro_fornecedor', [FornecedorController::class, 'Fornecedor'])->name('cadastro_fornecedor');
Route::post('/cadastro_fornecedor', [FornecedorController::class, 'store'])->name('fornecedores.store');

Route::get('/entregas', [EntregaController::class, 'index'])->name('entregas.index');
Route::post('/entregas', [EntregaController::class, 'store'])->name('entregas.store');
Route::get('/movimentacoes', [MovimentacaoController::class, 'index'])->name('movimentacoes.index');

Route::get('/login', [UsuarioController::class, 'login'])->name('login');
Route::post('/login', [UsuarioController::class, 'authenticate'])->middleware('throttle:5,1')->name('login.authenticate');
Route::post('/sair', [UsuarioController::class, 'logout'])->name('logout');
Route::get('/recuperar-senha', [UsuarioController::class, 'forgotPassword'])->name('password.request');
Route::post('/recuperar-senha', [UsuarioController::class, 'resetPassword'])->middleware('throttle:5,1')->name('password.update');
Route::get('/cadastro_usuario', [UsuarioController::class, 'cadastro_html'])->name('cadastro_usuario');
Route::post('/cadastro_usuario', [UsuarioController::class, 'store'])->middleware('throttle:10,1')->name('usuarios.store');

Route::get('/login_aula', [LoginController::class, 'mostrarlogin'])->name('login_aula');