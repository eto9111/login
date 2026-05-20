<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $fillable = ['user_id', 'contenido', 'rating', 'producto', 'tiempo_llegada', 'estado_paquete'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
