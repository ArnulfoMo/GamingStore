<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    protected $table='Promociones';
    protected $fillable=[
        'nombre',
        'descripcion',
        'tipo_decuento',
        'valor_descuento',
        'fecha_inicio',
        'fecha_fin',
        'activo',
        
    ];    
}
