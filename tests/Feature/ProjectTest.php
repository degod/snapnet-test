<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

beforeEach(function () {
    Task::factory()->count(5)->create();
});

test('view all projects', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/project')
        ->assertStatus(200)
        ->assertSee('All Projects');
});

test('view single project', function () {
    $project = Project::get()->first();
    $tasks = $project->tasks ?? null;

    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('view.project-details', ['project' => $project]))
        ->assertStatus(200)
        ->assertSee('Related Tasks');
    expect($project)
        ->toBeObject();
    expect($tasks)
        ->toBeObject();
});
