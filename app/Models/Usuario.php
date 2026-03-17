<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //campos que podem ser preenchidos no banco
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // campo que é salvo no banco mas quando for chamado na tela em formato JSON ele não é retornado
    protected $hidden = [
        'password',
    ];
}
