<?php

namespace Database\Factories;

use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    protected $model = Resident::class;

    public function definition(): array
    {
        // allow linking to existing RT/RW via factory relationships when not provided
        return [
            'rt_id' => RT::factory(),
            'rw_id' => RW::factory(),
            'nik' => $this->faker->unique()->numerify('###############'),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'dob' => $this->faker->date(),
            'kk_number' => $this->faker->optional()->numerify('###############'),
            'occupation' => $this->faker->randomElement(['Farmer', 'Teacher', 'Employee', 'Student', 'Unemployed']),
            'education' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Pasca']),
            'address' => $this->faker->address(),
            'phone' => $this->faker->e164PhoneNumber(),
            'source_import' => 'seeder',
        ];
    }
}
