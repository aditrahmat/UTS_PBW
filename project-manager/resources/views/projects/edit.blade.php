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

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>