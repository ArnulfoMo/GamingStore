<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoVarianteSeeder extends Seeder
{
    private const GTA_VI_LICENCIA_PRECIO_HNL = 2300.00;

    private const PRECIOS_HNL = [
        'The Legend of Zelda: Tears of the Kingdom' => ['Nintendo Switch' => 1390.00],
        'Super Mario Bros. Wonder' => ['Nintendo Switch' => 1200.00],
        'Mario Kart 8 Deluxe' => ['Nintendo Switch' => 1200.00],
        'Elden Ring' => ['PlayStation 5' => 990.00, 'Xbox Series X|S' => 1200.00],
        'Dark Souls III' => ['PlayStation 4' => 600.00, 'Xbox Series X|S' => 700.00],
        'Sekiro: Shadows Die Twice' => ['Xbox Series X|S' => 900.00],
        'Cyberpunk 2077' => ['PlayStation 5' => 1390.00],
        'The Witcher 3: Wild Hunt' => ['PlayStation 5' => 800.00, 'Nintendo Switch' => 1100.00],
        'Red Dead Redemption 2' => ['PlayStation 4' => 650.00, 'Xbox Series X|S' => 650.00],
        'Grand Theft Auto V' => ['PlayStation 5' => 650.00, 'PlayStation 4' => 600.00, 'Xbox Series X|S' => 700.00],
        'God of War Ragnarök' => ['PlayStation 5' => 990.00, 'PlayStation 4' => 850.00],
        'Forza Horizon 5' => ['Xbox Series X|S' => 1490.00],
        'Halo Infinite' => ['Xbox Series X|S' => 700.00],
        'Resident Evil 4' => ['PlayStation 5' => 800.00, 'PlayStation 4' => 800.00, 'Xbox Series X|S' => 1490.00],
        'Resident Evil Village' => ['PlayStation 5' => 700.00, 'Xbox Series X|S' => 1100.00],
        'Street Fighter 6' => ['PlayStation 5' => 900.00, 'PlayStation 4' => 650.00, 'Xbox Series X|S' => 1390.00],
        'Final Fantasy VII Remake Intergrade' => ['PlayStation 5' => 990.00],
        'Final Fantasy XVI' => ['PlayStation 5' => 990.00],
        'Hogwarts Legacy' => ['PlayStation 5' => 1100.00, 'PlayStation 4' => 990.00, 'Xbox Series X|S' => 1590.00, 'Nintendo Switch' => 1100.00],
        'Mortal Kombat 1' => ['PlayStation 5' => 990.00, 'Xbox Series X|S' => 990.00],
        'Hollow Knight' => ['PlayStation 4' => 900.00, 'Nintendo Switch' => 990.00],
        'Dead Cells' => ['Nintendo Switch' => 700.00, 'PC' => 675.98],
        'The Legend of Zelda: Ocarina of Time' => ['Nintendo Switch 2' => 1622.72],
    ];

    private const PRECIO_REFERENCIA_HNL = [
        'PlayStation 5' => 990.00,
        'PlayStation 4' => 900.00,
        'Xbox Series X|S' => 990.00,
        'Nintendo Switch' => 1200.00,
        'PC' => 990.00,
    ];

    public function run(): void
    {
        $formatos = [
            'PlayStation 5' => [1, 'Físico'],
            'PlayStation 4' => [1, 'Físico'],
            'Xbox Series X|S' => [1, 'Físico'],
            'Nintendo Switch' => [1, 'Físico'],
            'Nintendo Switch 2' => [2, 'Licencia digital'],
            'PC' => [2, 'Digital'],
        ];

        foreach (VideojuegoSeeder::GAMES as $game) {
            $productoId = DB::table('productos')->where('nombre', $game['nombre'])->value('id');
            $videojuegoId = DB::table('videojuegos')->where('nombre', $game['nombre'])->value('id');
            $edicionId = DB::table('ediciones')
                ->where('videojuego_id', $videojuegoId)
                ->where('nombre', 'Estándar')
                ->value('id');

            foreach ($game['plataformas'] as $plataforma) {
                $esLicenciaGtaVi = $game['nombre'] === 'Grand Theft Auto VI';
                [$formato, $formatoNombre] = $esLicenciaGtaVi
                    ? [2, 'Licencia digital']
                    : $formatos[$plataforma];
                $precioHnl = $esLicenciaGtaVi
                    ? self::GTA_VI_LICENCIA_PRECIO_HNL
                    : (self::PRECIOS_HNL[$game['nombre']][$plataforma]
                        ?? self::PRECIO_REFERENCIA_HNL[$plataforma]);
                $sku = 'GS-' . Str::upper(Str::slug($game['nombre'])) . '-' . Str::upper(Str::slug($plataforma));
                $platformId = DB::table('plataformas')->where('nombre', $plataforma)->value('id');

                DB::table('producto_variantes')->updateOrInsert(
                    ['sku' => $sku],
                    [
                        'producto_id' => $productoId,
                        'plataforma_id' => $platformId,
                        'edicion_id' => $edicionId,
                        'codigo_barras' => null,
                        'nombre_variante' => $formatoNombre . ' · ' . $plataforma,
                        'formato' => $formato,
                        'precio' => $precioHnl,
                        'fecha_disponibilidad' => null,
                        'activo' => 1,
                    ],
                );
            }
        }

        $hardware = [
            [
                'nombre' => 'Memoria / Disco duro SSD M2 de 500 GB Kingston',
                'sku' => 'GS-SSD-M2-KINGSTON-500GB',
                'variante' => 'SSD M.2 Kingston 500 GB',
                'precio' => 2000.00,
            ],
            [
                'nombre' => 'Memoria / Disco duro interno SSD de 240 GB Kingston',
                'sku' => 'GS-SSD-SATA-KINGSTON-240GB',
                'variante' => 'SSD SATA III Kingston 240 GB',
                'precio' => 2100.00,
            ],
            [
                'nombre' => 'Memoria / Disco duro interno SSD de 480 GB Kingston',
                'sku' => 'GS-SSD-SATA-KINGSTON-480GB',
                'variante' => 'SSD SATA III Kingston 480 GB',
                'precio' => 3000.00,
            ],
            [
                'nombre' => 'Mouse Gaming PRO Logitech',
                'sku' => 'GS-MOUSE-GAMING-PRO-LOGITECH',
                'variante' => 'Mouse Gaming PRO Logitech',
                'precio' => 1300.00,
            ],
            [
                'nombre' => 'XBOX Control Inalambrico Carbon Black Microsoft',
                'sku' => 'GS-XBOX-CONTROL-CARBON-BLACK',
                'variante' => 'Control Xbox inalámbrico Carbon Black',
                'precio' => 1490.00,
            ],
            [
                'nombre' => 'PS5 Control DualSense Negro Sony',
                'sku' => 'GS-PS5-CONTROL-DUALSENSE-NEGRO',
                'variante' => 'Control DualSense Negro Sony',
                'precio' => 1690.00,
            ],
        ];

        foreach ($hardware as $item) {
            $productoId = DB::table('productos')->where('nombre', $item['nombre'])->value('id');

            DB::table('producto_variantes')->updateOrInsert(
                ['sku' => $item['sku']],
                [
                    'producto_id' => $productoId,
                    'plataforma_id' => null,
                    'edicion_id' => null,
                    'codigo_barras' => null,
                    'nombre_variante' => $item['variante'],
                    'formato' => 1,
                    'precio' => $item['precio'],
                    'fecha_disponibilidad' => null,
                    'activo' => 1,
                ],
            );
        }
    }
}
