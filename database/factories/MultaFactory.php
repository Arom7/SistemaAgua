<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Multa>
 */
class MultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'criterio_infracion'=>$this->faker->word,
            'descripcion_infracion'=>$this->faker->sentence,
            'monto_infraccion'=>$this->faker->randomFloat(2,1,100)
        ];
    }
}
