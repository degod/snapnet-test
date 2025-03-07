@extends('layout')
@section('title', 'Failed Jobs')

@section('body')
<h1>Failed Jobs</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">UUID</th>
            <th scope="col">Connection</th>
            <th scope="col">Queue</th>
            <th scope="col">Exception</th>
            <th scope="col">Failed At</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr>
            <th scope="row">{{ $job->id }}</th>
            <td>{{ $job->uuid }}</td>
            <td>{{ $job->connection }}</td>
            <td>{{ $job->queue }}</td>
            <td>{{ $job->exception }}</td>
            <td>{{ \Carbon\Carbon::parse($job->failed_at)->format('g:ia F jS, Y') }}</td>
        </tr>
        @empty
        <tr>
            <th colspan="6" class="text-center">
                No Failed Jobs<br>
            </th>
        </tr>
        @endforelse
    </tbody>
</table>
@if(!empty($jobs))
<nav aria-label="...">
    {!! $jobs->links() !!}
</nav>
@endif
@endsection