<?php

namespace Database\Seeders;

use App\Models\Consumo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ConsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Log::info('Seeder iniciado');
        Consumo::factory()->count(55)->create();
        Log::info('Seeder completado');
    }
}
