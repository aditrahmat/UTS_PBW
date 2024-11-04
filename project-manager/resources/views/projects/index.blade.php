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
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>{{ $project->status }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <!-- Bootstrap Accordion for Tasks -->
                        <div class="accordion" id="accordion-{{ $project->id }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ $project->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $project->id }}" aria-expanded="false" aria-controls="collapse-{{ $project->id }}">
                                        Tugas dalam Proyek: {{ $project->name }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $project->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $project->id }}" data-bs-parent="#accordion-{{ $project->id }}">
                                    <div class="accordion-body">
                                    @foreach ($project->tasks as $task)
                                    <div class="d-flex justify-content-between">
                                        <p>{{ $task->task_name }} - {{ $task->status }}</p>
                                            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengubah status task ini?')">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                                            </form>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Accordion -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
