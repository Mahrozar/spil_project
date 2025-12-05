<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'category' => $this->faker->randomElement(['infrastruktur', 'kebersihan', 'keamanan', 'lainnya']),
            'description' => $this->faker->paragraph(2),
            'photo' => null,
            'location' => $this->faker->address(),
            'status' => $this->faker->randomElement(['open', 'investigating', 'closed']),
        ];
    }
}
