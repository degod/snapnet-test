<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function createTask()
    {
        $statuses = array_map(fn($status) => str_replace('_', '-', $status), array_keys(task_statuses()));
        $projects = Project::all();
        return view('tasks.create', compact('statuses', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTask(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        $request->session()->flash('success', "Task created successfully");

        return redirect(route('view.project-details', ['project' => $task->project]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTask(Task $task)
    {
        $statuses = array_map(fn($status) => str_replace('_', '-', $status), array_keys(task_statuses()));
        $projects = Project::all();
        return view('tasks.edit', compact('statuses', 'projects', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTask(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->except('_token'));
        $request->session()->flash('success', "Task updated successfully");

        return redirect(route('view.project-details', ['project' => $task->project]));
    }
}
