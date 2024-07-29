<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //OtbSeeder::class,
            //SocioSeeder::class,
            //TelefonoSeeder::class,
            //UsuarioSeeder::class,
            // Tabla intermedia Rol >--< Usuario
            PropiedadSeeder::class,
            MultaSeeder::class,
            //tabla intermedia Propiedad >--< Multa
            PropiedadMultaSeeder::class,
            MedidorSeeder::class,
            ConsumoSeeder::class,
            ReciboSeeder::class
        ]);
    }
}
