<?php

namespace App\Models;

use App\Jobs\SendTaskReminderJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'project_id',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($task) {
            if ($task->due_date && now()->lt($task->due_date)) {
                SendTaskReminderJob::dispatch($task)->onQueue('emails');
            }
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
