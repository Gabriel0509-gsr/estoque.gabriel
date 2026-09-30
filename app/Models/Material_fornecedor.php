<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material_fornecedor extends Model
{
    protected $table = 'material_fornecedor';

    protected $fillable = [
        'fornecedor_id',
        'material_id',
    ];
}
