<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'administrador' => 'Gestiona usuarios, permisos y la administración de la tienda.',
            'operador' => 'Realiza las tareas de soporte y almacén autorizadas.',
            'cliente' => 'Compra productos y consulta sus pedidos y licencias.',
        ] as $nombre => $descripcion) {
            Role::updateOrCreate(['nombre' => $nombre], ['descripcion' => $descripcion]);
        }
    }
}
