<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'descricao',
        'categoria',
        'quantidade',
        'estoque_minimo',
        'localizacao',
        'estado_conservacao',
    ];
}
