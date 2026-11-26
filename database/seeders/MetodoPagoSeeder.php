<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['nombre' => 'Efectivo', 'descripcion' => 'Pago en efectivo en sucursal.'],
            ['nombre' => 'Tarjeta de crédito', 'descripcion' => 'Pago con tarjeta de crédito.'],
            ['nombre' => 'Tarjeta de débito', 'descripcion' => 'Pago con tarjeta de débito.'],
            ['nombre' => 'Transferencia bancaria', 'descripcion' => 'Pago por transferencia bancaria.'],
            ['nombre' => 'Pago contra entrega', 'descripcion' => 'Pago al recibir el pedido.'],
        ] as $metodo) {
            DB::table('metodos_pago')->updateOrInsert(
                ['nombre' => $metodo['nombre']],
                [...$metodo, 'estado' => 1, 'created_at' => now(), 'updated_at' => now()],
            );
        }
    }
}
