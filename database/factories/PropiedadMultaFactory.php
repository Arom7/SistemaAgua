<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Propiedad;
use App\Models\Multa;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropiedadMulta>
 */
class PropiedadMultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'propiedad_id' => Propiedad::all()->random()->id,
            'infracion_id' => Multa::all()->random()->id,
            'fecha_multa' => $this->faker->dateTimeThisYear,
            'estado_pago' => $this->faker->boolean,
        ];
    }
}
