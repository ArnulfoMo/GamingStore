<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Direccion extends Model
{
    protected $table = 'direcciones';

    protected $fillable = [
        'departamento',
        'ciudad',
        'colonia',
        'calle',
        'referencia',
    ];

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'usuario_direcciones', 'direccion_id', 'usuario_id')
            ->withPivot('principal');
    }
}
