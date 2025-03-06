<?php

use App\Models\Task;

beforeEach(function () {
    Task::factory()->count(5)->create();
});

test('view create task screen', function () {
    $this->get('/task/create')
        ->assertStatus(200)
        ->assertSee('Create New Task');
});

test('view edit task screen', function () {
    $task = Task::first();
    $this->get(route('edit.task', ['task' => $task]))
        ->assertStatus(200)
        ->assertSee('Edit Task');
});
