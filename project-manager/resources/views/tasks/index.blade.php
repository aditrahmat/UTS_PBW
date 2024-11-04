@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Tugas untuk Proyek: {{ $project->name }}</h2>
    <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn btn-success">Tambah Tugas</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Tugas</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->assigned_to }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <a href="{{ route('projects.tasks.edit', [$project->id, $task->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('projects.tasks.destroy', [$project->id, $task->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali ke Daftar Proyek</a>
</div>
@endsection
