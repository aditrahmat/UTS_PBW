@extends('layouts.app') <!-- Ganti 'layouts.app' sesuai dengan layout yang Anda gunakan -->

@section('content')
<div class="container">
    <h2>Tambah Proyek</h2>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf <!-- Token CSRF untuk keamanan -->
        
        <div class="form-group">
            <label for="name">Nama Proyek:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="form-group">
            <label for="end_date">Tanggal Selesai:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
