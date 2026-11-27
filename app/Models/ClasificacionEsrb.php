<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClasificacionEsrb extends Model
{
    protected $table = 'clasificaciones_esrb';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'edad_minima',
        'descripcion',
    ];

    public function videojuegos(): HasMany
    {
        return $this->hasMany(Videojuegos::class, 'clasificacion_esrb_id');
    }
}
