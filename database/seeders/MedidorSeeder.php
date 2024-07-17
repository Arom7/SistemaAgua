<?php

namespace Database\Seeders;

use App\Models\Medidor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medidor::factory()->count(50)->create();
    }
}
