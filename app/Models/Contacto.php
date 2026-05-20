<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'correo',
        'edad',
        'personaje_favorito',
        'equipo_favorito',
        'mensaje',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
