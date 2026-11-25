<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasificacionEsrbSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['codigo' => 'EC', 'nombre' => 'Early Childhood', 'edad_minima' => 3, 'descripcion' => 'Contenido apropiado para niñas y niños pequeños.'],
            ['codigo' => 'E', 'nombre' => 'Everyone', 'edad_minima' => 6, 'descripcion' => 'Contenido apto para todas las edades.'],
            ['codigo' => 'E10+', 'nombre' => 'Everyone 10+', 'edad_minima' => 10, 'descripcion' => 'Contenido apto desde los 10 años.'],
            ['codigo' => 'T', 'nombre' => 'Teen', 'edad_minima' => 13, 'descripcion' => 'Contenido recomendado desde los 13 años.'],
            ['codigo' => 'M', 'nombre' => 'Mature 17+', 'edad_minima' => 17, 'descripcion' => 'Contenido recomendado desde los 17 años.'],
        ] as $clasificacion) {
            DB::table('clasificaciones_esrb')->updateOrInsert(
                ['codigo' => $clasificacion['codigo']],
                array_diff_key($clasificacion, ['codigo' => true]),
            );
        }
    }
}
