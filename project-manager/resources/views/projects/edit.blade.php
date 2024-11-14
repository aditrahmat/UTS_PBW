@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Proyek</h2>
    <form action="{{ route('projects.update', $projects->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menggunakan method PUT untuk update data -->

        <div class="form-group">
            <label for="name">Nama Proyek:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $projects->name }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $projects->description }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $projects->start_date }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">Tanggal Selesai:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $projects->end_date }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Not Started" {{ $projects->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                <option value="In Progress" {{ $projects->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $projects->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
<!-- Task fields-->
<h4 class="mt-4">Tasks</h4>
@foreach($projects->tasks as $index => $task)
    <div class="card mb-3">
        <div class="card-body">
            <!-- Hidden input for task ID -->
            <input type="hidden" name="task_id[]" value="{{ $task->id }}">
            
            <div class="form-group">
                <label for="task_name_{{ $index }}">Nama Task:</label>
                <input type="text" class="form-control" id="task_name_{{ $index }}" name="task_name[]" value="{{ $task->task_name }}" required>
            </div>

            <div class="form-group">
                <label for="assigned_to_{{ $index }}">Diberikan kepada:</label>
                <input type="text" class="form-control" id="assigned_to_{{ $index }}" name="assigned_to[]" value="{{ $task->assigned_to }}" required>
            </div>

            <div class="form-group">
                <label for="task_status_{{ $index }}">Status Task:</label>
                <select class="form-control" id="task_status_{{ $index }}" name="task_status[]">
                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="due_date_{{ $index }}">Tanggal Deadline:</label>
                <input type="date" class="form-control" id="due_date_{{ $index }}" name="due_date[]" value="{{ $task->due_date }}">
            </div>
        </div>
    </div>
@endforeach

<button type="submit" class="btn btn-primary">Perbarui</button>

    </form>
</div>
@endsection