<?php

namespace Database\Factories;

use App\Models\RT;
use App\Models\RW;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RT>
 */
class RTFactory extends Factory
{
    protected $model = RT::class;

    public function definition(): array
    {
        return [
            'rw_id' => RW::factory(),
            'name' => 'RT ' . $this->faker->numberBetween(1, 1000),
            'leader_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'centroid_lat' => $this->faker->latitude(),
            'centroid_lng' => $this->faker->longitude(),
        ];
    }
}
