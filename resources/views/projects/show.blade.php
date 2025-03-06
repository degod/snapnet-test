@extends('layout')
@section('title', 'Related Tasks')

@section('body')
<h1>Related Tasks</h1>
<a href="{{ route('view.projects') }}" class="btn btn-secondary mb-5">Back to Project</a>
<a href="{{ route('create.task') }}" class="btn btn-danger mb-5">Create New Task</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Project</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Date Created</th>
            <th scope="col">Due Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($project->tasks as $task)
        <tr>
            <th scope="row">{{ $task->id }}</th>
            <td>{{ $project->title }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ \Carbon\Carbon::parse($task->created_at)->format('h:i A F jS, Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($task->due_date)->format('h:i A F jS, Y') }}</td>
            <td><a href="{{ route('edit.task', $task) }}" class="btn btn-danger btn-sm mt-3">Edit Task</a></td>
        </tr>
        @empty
        <tr>
            <th colspan="8" class="text-center">
                No Task Yet<br>
                <a href="{{ route('create.task') }}" class="btn btn-primary btn-sm mt-3">Create New Task</a>
            </th>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection