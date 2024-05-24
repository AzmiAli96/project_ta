<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
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
            'no_bp'=>fake()->bothify('22########'),
            'nama'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'prodi_id'=>mt_rand(1,3),
            'ipk'=>fake()->bothify('#,#'),
            'status_id'=>mt_rand(1,4),
        ];
    }
}
