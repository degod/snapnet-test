<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create a project if none exists
        $project = Project::find(rand(1, 5)) ?? Project::factory()->create();

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->numberBetween(1, 10),
            'status' => str_replace("_", "-", array_keys(task_statuses())[rand(0, 2)]),
            'due_date' => $this->faker->dateTimeThisYear(),
            'project_id' => $project->id,
        ];
    }
}
