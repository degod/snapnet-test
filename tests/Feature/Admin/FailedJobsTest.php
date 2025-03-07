<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    // Create an admin user
    $this->admin = User::factory()->create(['role' => 'admin']);

    // Create a non-admin user
    $this->user = User::factory()->create(['role' => 'user']);

    // Insert a fake failed job into the database
    DB::table('failed_jobs')->insert([
        'uuid' => '123e4567-e89b-12d3-a456-426614174000',
        'connection' => 'database',
        'queue' => 'default',
        'payload' => json_encode(['job' => 'App\Jobs\ExampleJob']),
        'exception' => 'Test Exception Message',
        'failed_at' => now(),
    ]);
});

it('allows admin to view failed jobs', function () {
    actingAs($this->admin)
        ->get(route('view.failed-jobs'))
        ->assertStatus(200)
        ->assertSee('Failed Jobs')
        ->assertSee('Test Exception Message');
});

it('denies access to non-admin users', function () {
    actingAs($this->user)
        ->get(route('view.failed-jobs'))
        ->assertStatus(403);
});

it('redirects guests to login', function () {
    get(route('view.failed-jobs'))
        ->assertRedirect(route('login'));
});
