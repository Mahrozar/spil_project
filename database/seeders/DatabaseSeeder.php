<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Create a test user only if one doesn't exist
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt(env('TEST_USER_PASSWORD', 'password')),
            ]
        );
        // Create admin user
        $this->call(\Database\Seeders\AdminUserSeeder::class);

        // Create several regular users with letters and reports
        \App\Models\User::factory(10)->create()->each(function ($user) {
            // each user gets between 2 and 6 letters
            \App\Models\Letter::factory(rand(2, 6))->for($user)->create();

            // each user gets between 0 and 4 reports (simple factory data)
            $count = rand(0, 4);
            if ($count > 0) {
                \App\Models\Report::factory($count)->create([
                    'user_id' => $user->id,
                ]);
            }
        });

        // Create hierarchical RW -> RT -> Residents
        $rwCount = 5;
        $rtPerRwMin = 2;
        $rtPerRwMax = 5;
        $residentsPerRtMin = 10;
        $residentsPerRtMax = 30;

        \App\Models\RW::factory($rwCount)->create()->each(function ($rw) use ($rtPerRwMin, $rtPerRwMax, $residentsPerRtMin, $residentsPerRtMax) {
            $rtCount = rand($rtPerRwMin, $rtPerRwMax);
            \App\Models\RT::factory($rtCount)->create(['rw_id' => $rw->id])->each(function ($rt) use ($rw, $residentsPerRtMin, $residentsPerRtMax) {
                $residentCount = rand($residentsPerRtMin, $residentsPerRtMax);
                \App\Models\Resident::factory($residentCount)->create([
                    'rt_id' => $rt->id,
                    'rw_id' => $rw->id,
                ]);
            });
        });

        // Create some import summary files and sample error reports for dashboard preview
        $this->call(\Database\Seeders\DummyDataSeeder::class);
        // Create dummy facility reports for monitoring/demo
        $this->call(\Database\Seeders\ReportsDummySeeder::class);
    }
}
