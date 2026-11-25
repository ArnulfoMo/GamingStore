<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EdicionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (VideojuegoSeeder::GAMES as $game) {
            $videojuegoId = DB::table('videojuegos')
                ->where('nombre', $game['nombre'])
                ->value('id');

            DB::table('ediciones')->updateOrInsert(
                ['videojuego_id' => $videojuegoId, 'nombre' => 'Estándar'],
                ['descripcion' => 'Edición estándar del videojuego.'],
            );
        }
    }
}
