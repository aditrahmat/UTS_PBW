@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create New User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">level</label>
            <select name="level" id="level" class="form-select" required>
                <option value="Administrator">Administrator</option>
                <option value="User">User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create User</button>
    </form>
</div>
@endsection
