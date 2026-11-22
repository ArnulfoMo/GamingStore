<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facturas extends Model
{
    protected $table = 'facturas';

    public $timestamps = false;

    protected $fillable = [
        'venta_id',
        'rango_facturacion_id',
        'numero_factura',
        'CAI',
        'RTN_emisor',
        'nombre_cliente',
        'RTN_cliente',
        'subtotal',
        'descuento',
        'tasa_isv',
        'ISV',
        'total',
        'fecha_emision',
        'estado',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'descuento' => 'decimal:2',
        'tasa_isv' => 'decimal:4',
        'ISV' => 'decimal:2',
        'total' => 'decimal:2',
        'fecha_emision' => 'datetime',
    ];
}