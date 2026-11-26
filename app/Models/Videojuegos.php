<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videojuegos extends Model
{
    
    protected $table='Videojuegos';
    protected $fillable=[
        'nombre',
        'descripcion',
        'portada',
        'trailer',
        'requisitos_tecnicos',
        'fecha_lanzamiento',
        'es_preventa',
        'clasificacion_esrb_id',
        'activo',
        
    ];
}
