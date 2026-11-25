<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ediciones extends Model
{
    protected $table='Productos';

    protected $fillable=[
        'categoria_id',
        'videojuego_id',
        'nombre',
        'descripcion',
        
    ];

    public function Videojuegos()
    {
        return $this->belongsTo(Videojuegos::class);

    }
}
