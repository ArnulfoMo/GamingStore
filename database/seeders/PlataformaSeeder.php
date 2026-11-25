<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlataformaSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'PlayStation 5' => 'Consola de sobremesa de Sony, generación actual.',
            'PlayStation 4' => 'Consola de sobremesa de Sony.',
            'Xbox Series X|S' => 'Consolas de sobremesa de Microsoft, generación actual.',
            'Nintendo Switch' => 'Consola híbrida de Nintendo.',
            'PC' => 'Computadora personal con sistema Windows.',
        ] as $nombre => $descripcion) {
            DB::table('plataformas')->updateOrInsert(
                ['nombre' => $nombre],
                ['descripcion' => $descripcion, 'logo' => null, 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            );
        }
    }
}
