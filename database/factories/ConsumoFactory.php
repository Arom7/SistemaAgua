<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consumo>
 */
class ConsumoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha_aleatoria = $faker

        return [
            'propiedad_id_consumo',
            'consumo_total',
            'mes_correspondiente'
        ];
    }
}
