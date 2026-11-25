<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{   
    
    protected $table='Productos';
    protected $fillable=[
        'categoria_id',
        'videojuego_id',
        'nombre',
        'descripcion',
        'imagen',
        'activo',
        
    ];

    public function Categorias()
    {
        return $this->belongsTo(Categorias::class);

    }

    public function Videojuegos()
    {
        return $this->belongsTo(Videojuegos::class);

    }    
        

}
