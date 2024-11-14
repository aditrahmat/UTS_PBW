@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Proyek</h2>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf 
        
        <!-- Project Fields -->
        <div class="form-group mb-3">
            <label for="name">Nama Proyek:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="description">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        
        <div class="form-group mb-3">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="form-group mb-3">
            <label for="end_date">Tanggal Selesai:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <!-- Task Fields -->
        <h3>Tasks</h3>
        <div id="tasks-container">
            <div class="task mb-3 border p-3 rounded">
                <div class="form-group mb-2">
                    <label for="task_name[]">Nama Tugas:</label>
                    <input type="text" class="form-control" name="task_name[]" required>
                </div>
                
                <div class="form-group mb-2">
                    <label for="assigned_to[]">Ditugaskan kepada:</label>
                    <input type="text" class="form-control" name="assigned_to[]" required>
                </div>

                <div class="form-group mb-2">
                    <label for="status[]">Status:</label>
                    <select class="form-control" name="task_status[]">
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="due_date[]">Tanggal Jatuh Tempo:</label>
                    <input type="date" class="form-control" name="due_date[]">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="add-task">Tambah Tugas Lain</button>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('add-task').addEventListener('click', function() {
        const taskContainer = document.getElementById('tasks-container');
        const newTask = document.createElement('div');
        newTask.classList.add('task', 'mb-3', 'border', 'p-3', 'rounded');
        newTask.innerHTML = `
            <div class="form-group mb-2">
                <label>Nama Tugas:</label>
                <input type="text" class="form-control" name="task_name[]" required>
            </div>
            <div class="form-group mb-2">
                <label>Ditugaskan kepada:</label>
                <input type="text" class="form-control" name="assigned_to[]" required>
            </div>
            <div class="form-group mb-2">
                <label>Status:</label>
                <select class="form-control" name="task_status[]">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label>Tanggal Jatuh Tempo:</label>
                <input type="date" class="form-control" name="due_date[]">
            </div>
        `;
        taskContainer.appendChild(newTask);
    });
</script>
@endsection
