<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class UsuarioRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles =Rol::all();
        $usuarios = Usuario::all();

        $usuarios->each(function ($user) use ($roles) {
            // Asignar 2 roles aleatorios a cada usuario
            $user->roles()->attach(
                $roles->random(2)->pluck('id')->toArray()
            );
        });
    }
}
