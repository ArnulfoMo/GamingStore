<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DireccionSeeder extends Seeder
{
    public function run(): void
    {
        $direcciones = [
            ['departamento' => 'Francisco Morazán', 'ciudad' => 'Tegucigalpa', 'colonia' => 'Palmira', 'calle' => 'Bulevar Morazán', 'referencia' => 'Local de demostración, Plaza Central'],
            ['departamento' => 'Cortés', 'ciudad' => 'San Pedro Sula', 'colonia' => 'Barrio Río de Piedras', 'calle' => 'Avenida Circunvalación', 'referencia' => 'Local de demostración, nivel 1'],
            ['departamento' => 'Atlántida', 'ciudad' => 'La Ceiba', 'colonia' => 'El Centro', 'calle' => 'Avenida San Isidro', 'referencia' => 'Local de demostración, frente al parque'],
        ];

        foreach ($direcciones as $direccion) {
            DB::table('direcciones')->updateOrInsert(
                ['departamento' => $direccion['departamento'], 'ciudad' => $direccion['ciudad'], 'calle' => $direccion['calle']],
                [...$direccion, 'created_at' => now(), 'updated_at' => now()],
            );
        }
    }
}
