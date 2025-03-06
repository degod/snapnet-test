<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure admin exists
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('secretadmin'),
                'role' => 'admin',
            ]
        );

        // Generate additional users if needed
        User::factory(5)->create();
    }
}
