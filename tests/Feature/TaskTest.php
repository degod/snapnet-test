<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

beforeEach(function () {
    Task::factory()->count(5)->create();
});

test('view create task screen', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/task/create')
        ->assertStatus(200)
        ->assertSee('Create New Task');
});

test('store a new task', function () {
    $project = Project::first();
    $user = User::factory()->create();
    $taskData = [
        'title' => 'New Task',
        'description' => 'This is a test task',
        'status' => 'in-progress',
        'project_id' => $project->id,
        'user_id' => $user->id,
        'due_date' => now()->toDateString(),
    ];

    $response = $this->actingAs($user)->post(route('create.task-action'), $taskData);

    $response->assertRedirect(route('view.project-details', ['project' => $project]))
        ->assertSessionHas('success', 'Task created successfully');

    $this->assertDatabaseHas('tasks', ['title' => 'New Task']);
});

test('view edit task screen', function () {
    $task = Task::first();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('edit.task', ['task' => $task]))
        ->assertStatus(200)
        ->assertSee('Edit Task');
});

test('update an existing task', function () {
    $task = Task::first();
    $user = User::factory()->create();

    $updatedData = [
        'title' => 'Updated Task Title',
        'description' => 'Updated task description',
        'status' => 'completed',
        'project_id' => $task->project_id,
        'user_id' => $user->id,
        'due_date' => now()->toDateString(),
    ];


    $response = $this->actingAs($user)
        ->post(route('edit.task-action', ['task' => $task]), $updatedData);

    $response->assertRedirect(route('view.project-details', ['project' => $task->project]))
        ->assertSessionHas('success', 'Task updated successfully');

    $this->assertDatabaseHas('tasks', ['title' => 'Updated Task Title']);
});
