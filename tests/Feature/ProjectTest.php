<?php

use App\Models\Project;
use App\Models\Task;

beforeEach(function () {
    Task::factory()->count(5)->create();
});

test('view all projects', function () {
    $this->get('/project')
        ->assertStatus(200)
        ->assertSee('All Projects');
});

test('view single project', function () {
    $project = Project::get()->first();
    $tasks = $project->tasks ?? null;

    $this->get(route('view.project-details', ['project' => $project]))
        ->assertStatus(200)
        ->assertSee('Related Tasks');
    expect($project)
        ->toBeObject();
    expect($tasks)
        ->toBeObject();
});
