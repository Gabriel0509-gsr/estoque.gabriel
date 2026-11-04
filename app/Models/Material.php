<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material';
<<<<<<< HEAD

=======
>>>>>>> origin/main
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
