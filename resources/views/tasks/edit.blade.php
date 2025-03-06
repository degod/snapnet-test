@extends('layout')
@section('title', 'Edit Task')

@section('body')
<h1>Edit Task</h1>
<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('edit.task-action', ['task'=>$task]) }}" method="POST">
            {!! csrf_field() !!}
            <div class="mb-3">
                <label class="form-label">Project</label>
                <select name="project_id" class="form-control">
                    <option value="">Select a Project</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->id }}" @if($project->id==$task->project_id) 'selected' @endif>{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $task->title }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ $task->description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">Select a Status</option>
                    @foreach($statuses as $status)
                    <option value="{{ $status }}" @if($status==$task->status) 'selected' @endif>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Due Date</label>
                <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
            </div>

            <button class="btn btn-primary">Save Task</button>
        </form>
    </div>
</div>
@endsection