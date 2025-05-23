<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nidn'=> fake()->bothify('##########'),
            'nama'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'no_telp'=>fake()->bothify('08########'),
            'level'=>fake()->randomElement(['penguji','pembimbing']),
            'alamat'=>$this->faker->address(),
        ];
    }
}
