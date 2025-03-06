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
                    <option value="{{ $project->id }}" @if()>{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">Select a Status</option>
                    @foreach($statuses as $status)
                    <option value="{{ str_replace('_', '-', $status) }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Due Date</label>
                <input type="date" name="due_date" class="form-control">
            </div>

            <button class="btn btn-primary">Save Task</button>
        </form>
    </div>
</div>
@endsection