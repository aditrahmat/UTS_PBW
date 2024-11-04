@extends('layouts.app')

@section('content')
    <h1>Daftar Task untuk Project: {{ $project->project_name }}</h1>
    <table>
        <tr>
            <th>Nama Task</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Due Date</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->task_name }}</td>
                <td>{{ $task->assigned_to }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->due_date }}</td>
            </tr>
        @endforeach
    </table>
@endsection
