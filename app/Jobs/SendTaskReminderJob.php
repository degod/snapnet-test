<?php

namespace App\Jobs;

use App\Mail\TaskReminderMail;
use App\Models\Task;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTaskReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Task $task) {}

    public int $tries = 3;

    public int $backoff = 60;

    public function middleware(): array
    {
        return [(new WithoutOverlapping($this->task->id))->expireAfter(300)];
    }

    public function handle()
    {
        try {
            Mail::to($this->task->user->email)->send(new TaskReminderMail($this->task));

            Log::info("Task reminder email sent successfully for Task ID: {$this->task->id}");
        } catch (Exception $e) {
            Log::error("Failed to send task reminder email for Task ID: {$this->task->id}. Error: " . $e->getMessage());

            $this->fail($e);
        }
    }
}
