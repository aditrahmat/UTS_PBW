@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Tugas untuk Proyek: {{ $project->name }}</h2>
    <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="task_name" class="form-label">Nama Tugas</label>
            <input type="text" name="task_name" class="form-control" id="task_name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" id="description"></textarea>
        </div>

        <div class="mb-3">
            <label for="assigned_to" class="form-label">Assigned To</label>
            <input type="text" name="assigned_to" class="form-control" id="assigned_to">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" class="form-control" id="status" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control" id="due_date">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
