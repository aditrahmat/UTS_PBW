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
<div id="task-container">
            @foreach($projects->tasks as $index => $task)
                @include('tasks.partials.task', ['task' => $task, 'index' => $index])
            @endforeach
        </div>
<!-- Buttons -->
<button type="button" class="btn btn-secondary" onclick="addTask()">Tambah Task</button>
<button type="submit" class="btn btn-primary">Perbarui</button>
<!-- Buttons -->
 
<!-- Script tambah task-->
<script>
    let taskCount = {{ count($projects->tasks) }};
    function addTask() {
        let taskTemplate = `
            <div class="card mb-3">
                <div class="card-body">
                    <input type="hidden" name="task_id[]" value="">
                    <div class="form-group">
                        <label for="task_name_${taskCount}">Nama Task:</label>
                        <input type="text" class="form-control" id="task_name_${taskCount}" name="task_name[]" required>
                    </div>

                    <div class="form-group">
                        <label for="assigned_to_${taskCount}">Diberikan kepada:</label>
                        <input type="text" class="form-control" id="assigned_to_${taskCount}" name="assigned_to[]" required>
                    </div>

                    <div class="form-group">
                        <label for="task_status_${taskCount}">Status Task:</label>
                        <select class="form-control" id="task_status_${taskCount}" name="task_status[]">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="due_date_${taskCount}">Tanggal Deadline:</label>
                        <input type="date" class="form-control" id="due_date_${taskCount}" name="due_date[]">
                    </div>
                </div>
            </div>`;
        document.getElementById('task-container').insertAdjacentHTML('beforeend', taskTemplate);
        taskCount++;
    }
</script>
<!--END OF Script tambah task-->

    </form>
</div>
@endsection