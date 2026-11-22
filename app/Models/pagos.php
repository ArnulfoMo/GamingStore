<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'venta_id',
        'tipo_pago',
        'monto',
        'estado',
        'referencia_transaccion',
        'fecha_pago',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'fecha_pago' => 'datetime',
    ];
}
