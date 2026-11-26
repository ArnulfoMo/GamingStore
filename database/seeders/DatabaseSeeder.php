<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            TiendaSeeder::class,
            DireccionSeeder::class,
            SucursalSeeder::class,
            PlataformaSeeder::class,
            GeneroSeeder::class,
            ClasificacionEsrbSeeder::class,
            DesarrolladorSeeder::class,
            CategoriaSeeder::class,
            ProveedorSeeder::class,
            EmpresaEnvioSeeder::class,
            MetodoPagoSeeder::class,
            VideojuegoSeeder::class,
            ProductoSeeder::class,
            EdicionSeeder::class,
            ProductoVarianteSeeder::class,
        ]);
    }
}
