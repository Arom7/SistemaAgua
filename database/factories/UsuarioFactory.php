<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Socio;
use App\Models\Usuario;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'socio_id' => Socio::inRandomOrder()->first()->id,
            'username' => $this->generateUniqueUsername(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'contrasenia' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Generate a unique username.
     *
     * @return string
     */
    private function generateUniqueUsername(): string
    {
        $username = Str::slug($this->faker->firstName . '.' . $this->faker->lastName);

        while (Usuario::where('username', $username)->exists()) {
            $username = Str::slug($this->faker->firstName . '.' . $this->faker->lastName) . rand(1, 999);
        }

        return $username;
    }
}
