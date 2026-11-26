<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesarrolladorSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Nintendo EPD', 'FromSoftware', 'CD Projekt Red', 'Rockstar Games',
            'Santa Monica Studio', 'Insomniac Games', 'Guerrilla Games',
            'Sucker Punch Productions', 'Playground Games', '343 Industries',
            'The Coalition', 'Capcom', 'Square Enix', 'Larian Studios',
            'Avalanche Software', 'NetherRealm Studios', 'Team Cherry',
        ] as $nombre) {
            DB::table('desarrolladores')->updateOrInsert(['nombre' => $nombre], []);
        }
    }
}
