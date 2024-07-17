<?php

namespace Database\Seeders;

use App\Models\Telefono;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('telefonos')->truncate();

        Telefono::factory()->count(25)->create();
    }
}
