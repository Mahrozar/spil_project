<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create an admin user if it doesn't already exist
        $email = env('ADMIN_EMAIL', 'admin@gmail.com');
        $password = env('ADMIN_PASSWORD', 'ADMIN12345a#');

        $user = User::where('email', $email)->first();

        if (! $user) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => $email,
                'password' => bcrypt($password),
                'role' => 'admin',
            ]);
        } else {
            $user->update(['role' => 'admin']);
        }
    }
}
