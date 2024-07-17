<?php

namespace Database\Seeders;

use App\Models\Otb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('otbs')->truncate();

        Otb::create([
            'id' => 1,
            'nombre_comunidad_otb' => 'La Campinia II',
            'direccion_otb' => 'Av. Blanco Galindo Km 11'
        ]);
    }
}
