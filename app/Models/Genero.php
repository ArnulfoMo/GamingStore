<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genero extends Model
{
    protected $table = 'generos';

    protected $fillable = [
        'nombre',
    ];

    public function videojuegos(): BelongsToMany
    {
        return $this->belongsToMany(Videojuegos::class, 'videojuego_genero', 'genero_id', 'videojuego_id');
    }
}
