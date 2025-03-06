<?php

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
    $this->get('/project/1/show')
        ->assertStatus(200)
        ->assertSee('Related Tasks');
});
