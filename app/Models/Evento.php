<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'title',
        'description',
        'data_evento',
        'max_participantes',
        'user_id',
    ];

    /**
     * Relacionamento: um evento pertence a um usuário
     */
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
