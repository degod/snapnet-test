<?php

use App\Jobs\SendTaskReminderJob;
use App\Mail\TaskReminderMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

it('dispatches the task reminder job for tasks due in 24 hours', function () {
    Queue::fake();
    $user = User::factory()->create();

    $task = Task::factory()->create([
        'user_id' => $user->id,
        'due_date' => now()->addDay(),
    ]);
    $tasks = Task::whereDate('due_date', now()->addDay()->toDateString())->get();

    foreach ($tasks as $task) {
        SendTaskReminderJob::dispatch($task)->onQueue('emails');
    }

    Queue::assertPushed(SendTaskReminderJob::class);
});

it('sends an email when the task reminder job is processed', function () {
    Mail::fake();

    $user = User::factory()->create();

    $task = Task::factory()->create([
        'user_id' => $user->id,
        'due_date' => now()->addDay(),
    ]);
    SendTaskReminderJob::dispatch($task);

    Mail::assertSent(TaskReminderMail::class, function ($mail) use ($task) {
        return $mail->task->id === $task->id;
    });
});


it('dispatches the reminder job when a task is updated', function () {
    Queue::fake();

    $user = User::factory()->create();
    $task = Task::factory()->create([
        'user_id' => $user->id,
        'due_date' => now()->addDay(),
    ]);

    $task->update(['title' => 'Updated Task Title']);

    Queue::assertPushed(SendTaskReminderJob::class);
});

it('logs errors when job fails', function () {
    Log::shouldReceive('error')->once()->withArgs(fn($message) => str_contains($message, 'Failed to send task reminder email'));

    $task = Task::factory()->create();
    $job = new SendTaskReminderJob($task);

    Mail::shouldReceive('to')->andThrow(new Exception('Simulated email failure'));

    $job->handle();
});
