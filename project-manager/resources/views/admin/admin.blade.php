@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Admin Dashboard</h1>

    @if($projects->isEmpty())
        <div class="alert alert-warning">No projects found.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
