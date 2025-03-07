<?php

namespace App\Providers;

use App\Jobs\SendTaskReminderJob;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        Blade::if('role', function ($role) {
            return Auth::check() && Auth::user()->role === $role;
        });

        Schedule::call(function () {
            $tasks = Task::whereDate('due_date', now()->addDay()->toDateString())->get();

            foreach ($tasks as $task) {
                dispatch(new SendTaskReminderJob($task));
            }
        })->hourly();
    }
}
