<?php

namespace Database\Factories;

use App\Models\Otb;
use App\Models\Socio;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Socio>
 */
class SocioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Socio::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_socio' => $this->faker->name,
            'primer_apellido_socio' => $this->faker->lastName,
            'segundo_apellido_socio' => $this->faker->lastName,
            'ci_socio' => $this->faker->numerify('#########'),
            'otb_id' => Otb::first()->id
        ];
    }
}
