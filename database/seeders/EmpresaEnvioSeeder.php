<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaEnvioSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['nombre' => 'Cargo Express HN', 'telefono' => '2234-7001', 'correo' => 'soporte@cargo.test', 'sitio_web' => 'https://example.test/cargo'],
            ['nombre' => 'Envíos Nacionales', 'telefono' => '2234-7002', 'correo' => 'ayuda@envios.test', 'sitio_web' => 'https://example.test/envios'],
            ['nombre' => 'Retiro en sucursal', 'telefono' => null, 'correo' => 'contacto@gamingstore.test', 'sitio_web' => null],
        ] as $empresa) {
            DB::table('empresas_envio')->updateOrInsert(
                ['nombre' => $empresa['nombre']],
                [...$empresa, 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            );
        }
    }
}
