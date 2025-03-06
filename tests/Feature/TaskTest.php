<?php

use App\Models\Task;

beforeEach(function () {
    Task::factory()->count(5)->create();
});

test('view create task screen', function () {
    $this->get('/task')
        ->assertStatus(200)
        ->assertSee('Create New Task');
});
