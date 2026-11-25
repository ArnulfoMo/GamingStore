<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $categoriaId = DB::table('categorias')->where('nombre', 'Videojuegos')->value('id');

        foreach (VideojuegoSeeder::GAMES as $game) {
            $videojuegoId = DB::table('videojuegos')->where('nombre', $game['nombre'])->value('id');

            DB::table('productos')->updateOrInsert(
                ['nombre' => $game['nombre']],
                [
                    'categoria_id' => $categoriaId,
                    'videojuego_id' => $videojuegoId,
                    'descripcion' => $game['descripcion'],
                    'imagen' => null,
                    'activo' => 1,
                ],
            );
        }
    }
}
