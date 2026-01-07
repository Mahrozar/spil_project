<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Report;

class ReportsDummySeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $categories = array_keys(Report::getFacilityCategories());
        $typesMap = Report::getFacilityTypes();
        $priorities = array_keys(Report::getPriorityLabels());
        $statuses = array_keys(Report::getStatusLabels());

        // ensure there is at least one user to associate reports with
        $anyUserId = \App\Models\User::inRandomOrder()->value('id') ?: 1;

        for ($i = 0; $i < 30; $i++) {
            $cat = $faker->randomElement($categories);
            $types = $typesMap[$cat] ?? ['lainnya' => 'Lainnya'];
            $typeKey = $faker->randomElement(array_keys($types));

            // Insert a simple row compatible with the existing reports table schema
            // (many apps have older schema fields: category, description, photo, location, status)
            DB::table('reports')->insert([
                'user_id' => $anyUserId,
                'category' => $cat,
                'description' => $faker->paragraph(2),
                'photo' => null,
                'location' => $faker->address(),
                'status' => $faker->randomElement(['open','investigating','closed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
