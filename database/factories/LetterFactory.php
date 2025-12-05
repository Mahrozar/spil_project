<?php

namespace Database\Factories;

use App\Models\Letter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Letter>
 */
class LetterFactory extends Factory
{
    protected $model = Letter::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['surat_keluar', 'surat_masuk', 'permohonan']),
            'description' => $this->faker->sentence(8),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
