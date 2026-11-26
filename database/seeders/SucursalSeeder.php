<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalSeeder extends Seeder
{
    public function run(): void
    {
        $tiendaId = DB::table('tiendas')->where('RTN', '08011999123456')->value('id');

        $sucursales = [
            ['ciudad' => 'Tegucigalpa', 'nombre' => 'GamingStore Tegucigalpa'],
            ['ciudad' => 'San Pedro Sula', 'nombre' => 'GamingStore San Pedro Sula'],
            ['ciudad' => 'La Ceiba', 'nombre' => 'GamingStore La Ceiba'],
        ];

        foreach ($sucursales as $sucursal) {
            $direccionId = DB::table('direcciones')
                ->where('ciudad', $sucursal['ciudad'])
                ->value('id');

            DB::table('sucursales')->updateOrInsert(
                ['tienda_id' => $tiendaId, 'nombre' => $sucursal['nombre']],
                ['direccion_id' => $direccionId, 'telefono' => null, 'activo' => 1],
            );
        }
    }
}
