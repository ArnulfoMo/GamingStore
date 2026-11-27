<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plataforma extends Model
{
    protected $table = 'plataformas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'logo',
        'activo',
    ];

    public function videojuegos(): BelongsToMany
    {
        return $this->belongsToMany(Videojuegos::class, 'videojuego_plataforma', 'plataforma_id', 'videojuego_id');
    }

    public function variantes(): HasMany
    {
        return $this->hasMany(Producto_variantes::class, 'plataforma_id');
    }
}
