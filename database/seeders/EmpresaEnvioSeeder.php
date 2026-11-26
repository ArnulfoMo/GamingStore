<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaEnvioSeeder extends Seeder
{
    public function run(): void
    {
        // Renombra las filas de demostración existentes conservando sus IDs y referencias.
        if (DB::table('empresas_envio')->where('nombre', 'Cargo Expreso')->doesntExist()) {
            DB::table('empresas_envio')->where('nombre', 'Cargo Express HN')->update(['nombre' => 'Cargo Expreso']);
        }
        if (DB::table('empresas_envio')->where('nombre', 'FedEx')->doesntExist()) {
            DB::table('empresas_envio')->where('nombre', 'Envíos Nacionales')->update(['nombre' => 'FedEx']);
        }

        foreach ([
            ['nombre' => 'Cargo Expreso', 'telefono' => '22640024', 'correo' => 'soporte@cargoexpreso.hn', 'sitio_web' => 'https://www2.cargoexpreso.com/hn/'],
            ['nombre' => 'FedEx', 'telefono' => '+504.2544.0558', 'correo' => null, 'sitio_web' => 'https://www.fedex.com/es-hn/home.html'],
            ['nombre' => 'Retiro en sucursal', 'telefono' => null, 'correo' => 'contacto@gamingstore.test', 'sitio_web' => null],
        ] as $empresa) {
            DB::table('empresas_envio')->updateOrInsert(
                ['nombre' => $empresa['nombre']],
                [...$empresa, 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            );
        }
    }
}
