<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Acción', 'Aventura', 'RPG', 'Mundo abierto', 'Disparos', 'Plataformas',
            'Carreras', 'Deportes', 'Lucha', 'Terror', 'Estrategia', 'Familiar',
            'Roguelike', 'Metroidvania',
        ] as $nombre) {
            DB::table('generos')->updateOrInsert(
                ['nombre' => $nombre],
                ['created_at' => now(), 'updated_at' => now()],
            );
        }
    }
}
