<?php

namespace Database\Seeders;

use App\Models\Otb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OtbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Otb::create([
            'id' => 1,
            'nombre_comunidad' => 'La Campinia II',
            'direccion' => 'Av. Blanco Galindo Km 11'
        ]);
    }
}
