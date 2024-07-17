<?php

namespace Database\Factories;

use App\Models\Propiedad;
use App\Models\Socio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Propiedad>
 */
class PropiedadFactory extends Factory
{
    protected $model = Propiedad::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $socio = Socio::inRandomOrder()->first();

        if (!$socio) {
            $socio = Socio::factory()->create();
        }

        return [
            'socio_id' => $socio->id ,
            'cuadra_propiedad' => $this->faker->address ,
            'total_multas_propiedad'=> $this->faker->randomFloat(2, 1, 100),
            'descripcion_propiedad' => $this->faker->sentence,
        ];
    }
}
