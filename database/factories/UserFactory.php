<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // Default password
            'role' => 'user', // Default role
        ];
    }

    public function admin(): static
    {
        return $this->state(fn() => [
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secretadmin'),
            'role' => 'admin',
        ]);
    }
}
