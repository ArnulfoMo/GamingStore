<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        $proveedores = [
            ['nombre' => 'Distribuidora Pixel HN', 'rtn' => '08011999123457', 'contacto' => 'Equipo comercial', 'telefono' => '2234-1001', 'correo' => 'ventas@pixel.test'],
            ['nombre' => 'Importaciones Nova', 'rtn' => '08011999123458', 'contacto' => 'Atención a tiendas', 'telefono' => '2234-1002', 'correo' => 'pedidos@nova.test'],
            ['nombre' => 'Suministros GameHub', 'rtn' => '08011999123459', 'contacto' => 'Ventas mayoristas', 'telefono' => '2234-1003', 'correo' => 'mayoreo@gamehub.test'],
        ];

        foreach ($proveedores as $proveedor) {
            DB::table('proveedores')->updateOrInsert(
                ['nombre' => $proveedor['nombre']],
                [...$proveedor, 'direccion' => 'Dirección de demostración, Honduras', 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            );
        }
    }
}
