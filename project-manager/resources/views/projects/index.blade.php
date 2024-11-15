@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Proyek</h2>
    <a href="{{ route('projects.create') }}" class="btn btn-success">Tambah Proyek</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>
                    <!-- Tombol untuk Menampilkan Tugas dalam Proyek -->
                    <button class="btn btn-link link-underline link-underline-opacity-0 link-underline-opacity-100-hover" type="button" data-bs-toggle="collapse" data-bs-target="#tasks-{{ $project->id }}" aria-expanded="false" aria-controls="tasks-{{ $project->id }}">
                        {{ $project->name }}
                    </button>
                </td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td class="text-center text-dark">
                    @if ($project->status === 'Completed')
                        <span class="badge bg-success">{{ $project->status }}</span>
                    @elseif ($project->status === 'In Progress')
                        <span class="badge bg-warning">{{ $project->status }}</span>
                    @else
                        <span class="badge bg-secondary">{{ $project->status }}</span>
                    @endif

                    <!-- Progress Bar -->
                    <div class="progress mt-2" style="height: 20px;">
                        <div class="progress-bar text-dark
                            @if ($project->progress < 50) bg-danger progress-bar-striped
                            @elseif ($project->progress < 75) bg-warning progress-bar-striped
                            @else bg-success
                            @endif"
                            role="progressbar"
                            style="width: {{ $project->progress }}%;"
                            aria-valuenow="{{ $project->progress }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $project->progress }}%
                        </div>
                    </div>
                </td>
                <td>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <tr id="tasks-{{ $project->id }}" class="collapse">
                <td colspan="6">
                    <!-- List Group untuk Tasks -->
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">
                            <h5><strong>Tugas dalam project: {{ $project->name }}</h5></strong>
                        </div>
                        @forelse ($project->tasks as $task)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {{ $task->task_name }} - <span class="badge bg-{{ $task->status == 'Completed' ? 'success' : 'secondary' }}">{{ $task->status }}</span>
                                </div>
                                <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengubah status task ini?')">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex align-items-center">
                                        <select name="status" class="form-select form-select-sm w-auto me-2">
                                            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <div class="list-group-item text-muted">Tidak ada tugas untuk proyek ini.</div>
                        @endforelse
                    </div>
                    <!-- End of List Group -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
