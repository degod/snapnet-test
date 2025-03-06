<?php

use App\Models\Project;

beforeEach(function () {
    Project::factory()->count(5)->create();
});

test('view all projects', function () {
    $this->get('/project')
        ->assertStatus(200)
        ->assertSee('All Projects');
});
