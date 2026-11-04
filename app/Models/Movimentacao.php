<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsTo;
=======
>>>>>>> origin/main

class Movimentacao extends Model
{
    protected $table = 'movimentacao';

<<<<<<< HEAD
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'material_id',
        'fornecedor_id',
=======
    protected $fillable = [
        'usuario_id',
        'material_id',
>>>>>>> origin/main
        'tipo',
        'quantidade',
        'data_movimentacao',
        'observacao',
    ];
<<<<<<< HEAD

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }
=======
>>>>>>> origin/main
}
