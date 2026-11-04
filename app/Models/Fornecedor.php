<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedor';
<<<<<<< HEAD
    public $timestamps = false;
=======
>>>>>>> origin/main

    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'email',
    ];
}
