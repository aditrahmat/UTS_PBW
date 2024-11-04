@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Proyek</h2>
    <div class="card">
        <div class="card-body">
            <h3>{{ $project->name }}</h3>
            <p><strong>Deskripsi:</strong> {{ $project->description }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ $project->start_date }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $project->end_date }}</p>
            <p><strong>Status:</strong> {{ $project->status }}</p>
        </div>
    </div>
    <a href="{{ route('projects.index') }}" class="btn btn-primary mt-3">Kembali</a>
</div>