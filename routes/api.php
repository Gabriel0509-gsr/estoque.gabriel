<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialfornecedorController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LoginApiMiddleware;
use App\Http\Controllers\AuthController;

Route::post('/salvar_usuario', [UsuarioController::class, 'salvar_usuario']);
Route::get('/ver_usuario', [UsuarioController::class, 'ver_usuario']);
Route::get('/listar_usuarios', [UsuarioController::class, 'listar_usuarios']);
Route::put('/alterar_usuario', [UsuarioController::class, 'alterar_usuario'])->middleware(LoginApiMiddleware::class);
Route::delete('/deletar_usuario', [UsuarioController::class, 'deletar_usuario'])->middleware(LoginApiMiddleware::class);

Route::post('/salvar_fornecedor', [FornecedorController::class, 'salvar_fornecedor']);
Route::get('/ver_fornecedor', [FornecedorController::class, 'ver_fornecedor']);
Route::get('/listar_fornecedores', [FornecedorController::class, 'listar_fornecedores']);
Route::get('/listar_fornecedores_simples', [FornecedorController::class, 'listar_fornecedores_simples']);
Route::put('/alterar_fornecedor', [FornecedorController::class, 'alterar_fornecedor']);
Route::delete('/deletar_fornecedor', [FornecedorController::class, 'deletar_fornecedor']);

Route::post('/salvar_material', [MaterialController::class, 'salvar_material']);
Route::get('/ver_material', [MaterialController::class, 'ver_material']);
Route::get('/listar_materiais', [MaterialController::class, 'listar_materiais']);
Route::get('/listar_materiais_simples', [MaterialController::class, 'listar_materiais_simples']);
Route::put('/alterar_material', [MaterialController::class, 'alterar_material']);
Route::delete('/deletar_material', [MaterialController::class, 'deletar_material']);

Route::post('/salvar_movimentacao', [MovimentacaoController::class, 'salvar_movimentacao']);
Route::get('/ver_movimentacao', [MovimentacaoController::class, 'ver_movimentacao']);
Route::get('/listar_movimentacoes', [MovimentacaoController::class, 'listar_movimentacoes']);
Route::get('/listar_usuarios_simples', [MovimentacaoController::class, 'listar_usuarios_simples']);
Route::put('/alterar_movimentacao', [MovimentacaoController::class, 'alterar_movimentacao']);
Route::delete('/deletar_movimentacao', [MovimentacaoController::class, 'deletar_movimentacao']);

Route::post('/login', [UsuarioController::class, 'loginApi']);
Route::post('/logoutApi', [UsuarioController::class, 'logoutApi'])->middleware(LoginApiMiddleware::class);
Route::delete('/logoutApi', [UsuarioController::class, 'deletar_token'])->middleware(LoginApiMiddleware::class);
