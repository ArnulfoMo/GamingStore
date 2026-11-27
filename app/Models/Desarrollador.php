<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Desarrollador extends Model
{
    protected $table = 'desarrolladores';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function videojuegos(): BelongsToMany
    {
        return $this->belongsToMany(Videojuegos::class, 'videojuego_desarrollador', 'desarrollador_id', 'videojuego_id');
    }
}
