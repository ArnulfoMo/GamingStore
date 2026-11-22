<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class envios extends Model
{
    //

    protected $table = 'envios';

    protected $fillable = [
        'venta_id',
        'sucursal_id',
        'estado',
        'numero_seguimiento',
        'fecha_despacho',
        'fecha_entrega',
        'observaciones',
    ];

    protected $casts = [
        'estado' => 'integer',
        'fecha_despacho' => 'datetime',
        'fecha_entrega' => 'datetime',
    ];

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class);
    }

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }
}