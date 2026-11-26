<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Videojuegos' => 'Juegos físicos y digitales para distintas plataformas.',
            'Consolas' => 'Consolas de videojuegos y paquetes especiales.',
            'Accesorios' => 'Accesorios y periféricos para videojuegos.',
            'Mandos' => 'Controles y mandos para consolas y PC.',
            'Audio gaming' => 'Auriculares y equipos de audio para jugar.',
            'Tarjetas digitales' => 'Tarjetas prepago y saldo para plataformas.',
        ] as $nombre => $descripcion) {
            DB::table('categorias')->updateOrInsert(
                ['nombre' => $nombre],
                ['descripcion' => $descripcion, 'activo' => 1],
            );
        }
    }
}
