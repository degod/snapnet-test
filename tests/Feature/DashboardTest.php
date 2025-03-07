<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

it('displays correct dashboard statistics', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Project::factory()->count(5)->create();
    Task::factory()->count(10)->create([
        'status' => 'pending'
    ]);
    Task::factory()->count(7)->create([
        'status' => 'in-progress'
    ]);
    Task::factory()->count(3)->create([
        'status' => 'completed'
    ]);
    DB::table('failed_jobs')->insert([
        'uuid' => \Illuminate\Support\Str::uuid(),
        'connection' => 'database',
        'queue' => 'default',
        'payload' => '{}',
        'exception' => 'Test Exception',
        'failed_at' => now()
    ]);

    $response = $this->get(route('dashboard'));

    $response->assertOk()
        ->assertSee('Total Projects')
        ->assertSee('Total Tasks')
        ->assertSee('Pending Tasks')
        ->assertSee('In-Progress Tasks')
        ->assertSee('Completed Tasks')
        ->assertSee('Failed Jobs')
        ->assertSee('5')
        ->assertSee('20')
        ->assertSee('10')
        ->assertSee('7')
        ->assertSee('3')
        ->assertSee('1');
});
