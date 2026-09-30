<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'movimentacao';

    protected $fillable = [
        'usuario_id',
        'material_id',
        'tipo',
        'quantidade',
        'data_movimentacao',
        'observacao',
    ];
}
