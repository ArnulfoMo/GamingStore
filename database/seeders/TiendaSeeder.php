<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiendaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tiendas')->updateOrInsert(
            ['RTN' => '08011999123456'],
            [
                'nombre_tienda' => 'GamingStore Centro',
                'telefono' => '2234-5600',
                'correo' => 'contacto@gamingstore.test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
