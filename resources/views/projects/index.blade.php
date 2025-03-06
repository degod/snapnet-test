@extends('layout')
@section('title', 'All Projects')

@section('body')
<h1>All Projects</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Project Title</th>
            <th scope="col">Date Created</th>
            <th scope="col">By Whom</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
        <tr>
            <th scope="row">{{ $project->id }}</th>
            <td>{{ $project->title }}</td>
            <td>{{ \Carbon\Carbon::parse($project->created_at)->format('h:i A F jS, Y') }}</td>
            <td>{{ $project->created_by ?? 'N/A' }}</td>
            <td><a href="{{ route('view.project-details', ['project'=>$project]) }}" class="btn btn-warning">View tasks</a></td>
        </tr>
        @empty
        <tr>
            <th colspan="5" class="text-center">
                No Project Yet<br>
            </th>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection