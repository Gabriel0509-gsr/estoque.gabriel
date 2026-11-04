<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
<<<<<<< HEAD

=======
>>>>>>> origin/main
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'tipo_usuario',
        'cpf',
        'data_nascimento',
    ];
<<<<<<< HEAD

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'usuario_id');
    }
=======
>>>>>>> origin/main
}
