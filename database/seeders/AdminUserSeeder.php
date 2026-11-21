<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        DB::transaction(function () {
            $user = User::firstOrCreate(['email' => 'admin@gamingstore.hn'], [
                'name' => 'Administrador',
                'password' => Hash::make('Admin12345'),
            ]);

            $role = Role::where('nombre', 'administrador')->firstOrFail();
            $user->roles()->syncWithoutDetaching([$role->id]);
        });
    }
}
