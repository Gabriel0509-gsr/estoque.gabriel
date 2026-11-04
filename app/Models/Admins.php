<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admins extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'usuario_id',
        'nivel_acesso',
    ];
}
