<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto_variantes extends Model
{  
    
    protected $table='Producto_variantes';

    protected $fillable=[
        'producto_id',
        'plataforma_id',
        'edicion_id',
        'sku',
        'codigo_barras',
        
    ];

    public function Productos()
    {
        return $this->belongsTo(Productos::class);

    }

    public function Plataformas()
    {
        return $this->belongsTo(Plataformas::class);

    }

    public function Ediciones()
    {
        return $this->belongsTo(Ediciones::class);

    }
}
