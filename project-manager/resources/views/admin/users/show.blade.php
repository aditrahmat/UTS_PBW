@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <p class="card-text">level: {{ $user->level }}</p>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
