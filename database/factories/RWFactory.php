<?php

namespace Database\Factories;

use App\Models\RW;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RW>
 */
class RWFactory extends Factory
{
    protected $model = RW::class;

    public function definition(): array
    {
        return [
            'name' => 'RW ' . $this->faker->unique()->numberBetween(1, 50),
        ];
    }
}
