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

        $categoriaAlmacenamientoId = DB::table('categorias')->where('nombre', 'Almacenamiento')->value('id');
        $categoriaAccesoriosId = DB::table('categorias')->where('nombre', 'Accesorios')->value('id');

        foreach ([
            [
                'nombre' => 'Memoria / Disco duro SSD M2 de 500 GB Kingston',
                'categoria_id' => $categoriaAlmacenamientoId,
                'descripcion' => 'Unidad Kingston SSD M.2 de 500 GB para ampliar el almacenamiento de un equipo compatible.',
            ],
            [
                'nombre' => 'Memoria / Disco duro interno SSD de 240 GB Kingston',
                'categoria_id' => $categoriaAlmacenamientoId,
                'descripcion' => 'Unidad de estado sólido Kingston de 240 GB con interfaz SATA III.',
            ],
            [
                'nombre' => 'Memoria / Disco duro interno SSD de 480 GB Kingston',
                'categoria_id' => $categoriaAlmacenamientoId,
                'descripcion' => 'Unidad de estado sólido Kingston de 480 GB con interfaz SATA III.',
            ],
            [
                'nombre' => 'Mouse Gaming PRO Logitech',
                'categoria_id' => $categoriaAccesoriosId,
                'descripcion' => 'Mouse para gaming Logitech, modelo PRO.',
            ],
            [
                'nombre' => 'XBOX Control Inalambrico Carbon Black Microsoft',
                'categoria_id' => $categoriaAccesoriosId,
                'descripcion' => 'Control inalámbrico Microsoft Xbox, color Carbon Black.',
            ],
            [
                'nombre' => 'PS5 Control DualSense Negro Sony',
                'categoria_id' => $categoriaAccesoriosId,
                'descripcion' => 'Control inalámbrico Sony DualSense para PlayStation 5, color negro.',
            ],
        ] as $producto) {
            DB::table('productos')->updateOrInsert(
                ['nombre' => $producto['nombre']],
                [
                    'categoria_id' => $producto['categoria_id'],
                    'videojuego_id' => null,
                    'descripcion' => $producto['descripcion'],
                    'imagen' => null,
                    'activo' => 1,
                ],
            );
        }
    }
}
