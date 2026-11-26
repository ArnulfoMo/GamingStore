<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideojuegoSeeder extends Seeder
{
    public const GAMES = [
        ['nombre' => 'The Legend of Zelda: Tears of the Kingdom', 'fecha' => '2023-05-12', 'esrb' => 'E10+', 'desarrollador' => 'Nintendo EPD', 'generos' => ['Aventura', 'Acción'], 'plataformas' => ['Nintendo Switch'], 'descripcion' => 'Explora Hyrule y sus islas flotantes en una aventura de mundo abierto.'],
        ['nombre' => 'Super Mario Bros. Wonder', 'fecha' => '2023-10-20', 'esrb' => 'E', 'desarrollador' => 'Nintendo EPD', 'generos' => ['Plataformas', 'Familiar'], 'plataformas' => ['Nintendo Switch'], 'descripcion' => 'Aventura de plataformas de desplazamiento lateral en el Reino Flor.'],
        ['nombre' => 'Mario Kart 8 Deluxe', 'fecha' => '2017-04-28', 'esrb' => 'E', 'desarrollador' => 'Nintendo EPD', 'generos' => ['Carreras', 'Familiar'], 'plataformas' => ['Nintendo Switch'], 'descripcion' => 'Carreras arcade con personajes y circuitos del universo Mario.'],
        ['nombre' => 'Elden Ring', 'fecha' => '2022-02-25', 'esrb' => 'M', 'desarrollador' => 'FromSoftware', 'generos' => ['RPG', 'Acción', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'Xbox Series X|S', 'PC'], 'descripcion' => 'RPG de acción y fantasía ambientado en las Tierras Intermedias.'],
        ['nombre' => 'Dark Souls III', 'fecha' => '2016-04-12', 'esrb' => 'M', 'desarrollador' => 'FromSoftware', 'generos' => ['RPG', 'Acción'], 'plataformas' => ['PlayStation 4', 'Xbox Series X|S', 'PC'], 'descripcion' => 'RPG de acción desafiante en un mundo de fantasía oscura.'],
        ['nombre' => 'Sekiro: Shadows Die Twice', 'fecha' => '2019-03-22', 'esrb' => 'M', 'desarrollador' => 'FromSoftware', 'generos' => ['Acción', 'Aventura'], 'plataformas' => ['PlayStation 4', 'Xbox Series X|S', 'PC'], 'descripcion' => 'Aventura de acción centrada en el combate con espada y el sigilo.'],
        ['nombre' => 'Cyberpunk 2077', 'fecha' => '2020-12-10', 'esrb' => 'M', 'desarrollador' => 'CD Projekt Red', 'generos' => ['RPG', 'Disparos', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'Xbox Series X|S', 'PC'], 'descripcion' => 'RPG de mundo abierto ambientado en la ciudad futurista Night City.'],
        ['nombre' => 'The Witcher 3: Wild Hunt', 'fecha' => '2015-05-19', 'esrb' => 'M', 'desarrollador' => 'CD Projekt Red', 'generos' => ['RPG', 'Aventura', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch', 'PC'], 'descripcion' => 'Aventura de rol de mundo abierto protagonizada por Geralt de Rivia.'],
        ['nombre' => 'Red Dead Redemption 2', 'fecha' => '2018-10-26', 'esrb' => 'M', 'desarrollador' => 'Rockstar Games', 'generos' => ['Acción', 'Aventura', 'Mundo abierto'], 'plataformas' => ['PlayStation 4', 'Xbox Series X|S', 'PC'], 'descripcion' => 'Historia de acción y aventura ambientada en el oeste americano.'],
        ['nombre' => 'Grand Theft Auto V', 'fecha' => '2013-09-17', 'esrb' => 'M', 'desarrollador' => 'Rockstar Games', 'generos' => ['Acción', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X|S', 'PC'], 'descripcion' => 'Aventura de mundo abierto con tres protagonistas en Los Santos.'],
        ['nombre' => 'God of War Ragnarök', 'fecha' => '2022-11-09', 'esrb' => 'M', 'desarrollador' => 'Santa Monica Studio', 'generos' => ['Acción', 'Aventura'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'PC'], 'descripcion' => 'Aventura de acción mitológica protagonizada por Kratos y Atreus.'],
        ['nombre' => 'Marvel’s Spider-Man 2', 'fecha' => '2023-10-20', 'esrb' => 'T', 'desarrollador' => 'Insomniac Games', 'generos' => ['Acción', 'Aventura', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'PC'], 'descripcion' => 'Aventura de acción de mundo abierto con Peter Parker y Miles Morales.'],
        ['nombre' => 'Horizon Forbidden West', 'fecha' => '2022-02-18', 'esrb' => 'T', 'desarrollador' => 'Guerrilla Games', 'generos' => ['RPG', 'Acción', 'Aventura'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'PC'], 'descripcion' => 'Aloy explora nuevas tierras en una aventura de acción y ciencia ficción.'],
        ['nombre' => 'Ghost of Tsushima Director’s Cut', 'fecha' => '2020-07-17', 'esrb' => 'M', 'desarrollador' => 'Sucker Punch Productions', 'generos' => ['Acción', 'Aventura', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'PC'], 'descripcion' => 'Aventura de acción en el Japón feudal durante la invasión mongola.'],
        ['nombre' => 'Forza Horizon 5', 'fecha' => '2021-11-09', 'esrb' => 'E', 'desarrollador' => 'Playground Games', 'generos' => ['Carreras'], 'plataformas' => ['Xbox Series X|S', 'PC'], 'descripcion' => 'Carreras de mundo abierto en escenarios inspirados en México.'],
        ['nombre' => 'Halo Infinite', 'fecha' => '2021-12-08', 'esrb' => 'T', 'desarrollador' => '343 Industries', 'generos' => ['Disparos', 'Acción'], 'plataformas' => ['Xbox Series X|S', 'PC'], 'descripcion' => 'Shooter de ciencia ficción protagonizado por el Jefe Maestro.'],
        ['nombre' => 'Gears 5', 'fecha' => '2019-09-10', 'esrb' => 'M', 'desarrollador' => 'The Coalition', 'generos' => ['Disparos', 'Acción'], 'plataformas' => ['Xbox Series X|S', 'PC'], 'descripcion' => 'Shooter de acción con campaña y modos cooperativos.'],
        ['nombre' => 'Resident Evil 4', 'fecha' => '2023-03-24', 'esrb' => 'M', 'desarrollador' => 'Capcom', 'generos' => ['Terror', 'Acción'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X|S', 'PC'], 'descripcion' => 'Aventura de supervivencia y terror en una misión de rescate.'],
        ['nombre' => 'Resident Evil Village', 'fecha' => '2021-05-07', 'esrb' => 'M', 'desarrollador' => 'Capcom', 'generos' => ['Terror', 'Acción'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X|S', 'PC'], 'descripcion' => 'Historia de supervivencia y terror en una aldea aislada.'],
        ['nombre' => 'Street Fighter 6', 'fecha' => '2023-06-02', 'esrb' => 'T', 'desarrollador' => 'Capcom', 'generos' => ['Lucha'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X|S', 'PC'], 'descripcion' => 'Juego de lucha con modos competitivos, historia y entrenamiento.'],
        ['nombre' => 'Final Fantasy VII Remake Intergrade', 'fecha' => '2021-06-10', 'esrb' => 'T', 'desarrollador' => 'Square Enix', 'generos' => ['RPG', 'Acción'], 'plataformas' => ['PlayStation 5', 'PC'], 'descripcion' => 'RPG de acción que reimagina la aventura de Cloud en Midgar.'],
        ['nombre' => 'Final Fantasy XVI', 'fecha' => '2023-06-22', 'esrb' => 'M', 'desarrollador' => 'Square Enix', 'generos' => ['RPG', 'Acción'], 'plataformas' => ['PlayStation 5', 'PC'], 'descripcion' => 'RPG de acción y fantasía con combates entre invocaciones.'],
        ['nombre' => 'Baldur’s Gate 3', 'fecha' => '2023-08-03', 'esrb' => 'M', 'desarrollador' => 'Larian Studios', 'generos' => ['RPG', 'Estrategia'], 'plataformas' => ['PlayStation 5', 'Xbox Series X|S', 'PC'], 'descripcion' => 'RPG por turnos basado en el universo de Dungeons & Dragons.'],
        ['nombre' => 'Hogwarts Legacy', 'fecha' => '2023-02-10', 'esrb' => 'T', 'desarrollador' => 'Avalanche Software', 'generos' => ['RPG', 'Aventura', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X|S', 'Nintendo Switch', 'PC'], 'descripcion' => 'RPG de acción ambientado en el mundo mágico de Hogwarts.'],
        ['nombre' => 'Mortal Kombat 1', 'fecha' => '2023-09-19', 'esrb' => 'M', 'desarrollador' => 'NetherRealm Studios', 'generos' => ['Lucha', 'Acción'], 'plataformas' => ['PlayStation 5', 'Xbox Series X|S', 'PC'], 'descripcion' => 'Juego de lucha con una nueva historia y sistema de asistentes.'],
        ['nombre' => 'Hollow Knight', 'fecha' => '2017-02-24', 'esrb' => 'E10+', 'desarrollador' => 'Team Cherry', 'generos' => ['Acción', 'Aventura', 'Plataformas'], 'plataformas' => ['PlayStation 4', 'Nintendo Switch', 'PC'], 'descripcion' => 'Aventura de acción dibujada a mano por el reino subterráneo de Hallownest.'],
        ['nombre' => 'Hollow Knight: Silksong', 'fecha' => '2025-09-04', 'esrb' => 'E10+', 'desarrollador' => 'Team Cherry', 'generos' => ['Acción', 'Aventura', 'Plataformas'], 'plataformas' => ['PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch', 'PC'], 'descripcion' => 'Aventura de acción protagonizada por Hornet en el reino de Pharloom.'],
        ['nombre' => 'Grand Theft Auto VI', 'fecha' => '2026-11-19', 'esrb' => 'M', 'desarrollador' => 'Rockstar Games', 'generos' => ['Acción', 'Aventura', 'Mundo abierto'], 'plataformas' => ['PlayStation 5', 'Xbox Series X|S'], 'descripcion' => 'Aventura de mundo abierto protagonizada por Jason y Lucia en el estado de Leonida.'],
    ];

    public function run(): void
    {
        foreach (self::GAMES as $game) {
            $ratingId = DB::table('clasificaciones_esrb')->where('codigo', $game['esrb'])->value('id');

            DB::table('videojuegos')->updateOrInsert(
                ['nombre' => $game['nombre']],
                [
                    'descripcion' => $game['descripcion'],
                    'portada' => null,
                    'trailer' => null,
                    'requisitos_tecnicos' => null,
                    'fecha_lanzamiento' => $game['fecha'],
                    'es_preventa' => 0,
                    'clasificacion_esrb_id' => $ratingId,
                    'activo' => 1,
                ],
            );

            $videojuegoId = DB::table('videojuegos')->where('nombre', $game['nombre'])->value('id');
            $desarrolladorId = DB::table('desarrolladores')->where('nombre', $game['desarrollador'])->value('id');
            DB::table('videojuego_desarrollador')->updateOrInsert(
                ['videojuego_id' => $videojuegoId, 'desarrollador_id' => $desarrolladorId],
                [],
            );

            foreach ($game['generos'] as $genero) {
                $generoId = DB::table('generos')->where('nombre', $genero)->value('id');
                DB::table('videojuego_genero')->updateOrInsert(
                    ['videojuego_id' => $videojuegoId, 'genero_id' => $generoId],
                    [],
                );
            }

            foreach ($game['plataformas'] as $plataforma) {
                $plataformaId = DB::table('plataformas')->where('nombre', $plataforma)->value('id');
                DB::table('videojuego_plataforma')->updateOrInsert(
                    ['videojuego_id' => $videojuegoId, 'plataforma_id' => $plataformaId],
                    [],
                );
            }
        }
    }
}
