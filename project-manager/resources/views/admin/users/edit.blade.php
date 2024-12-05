@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">level</label>
            <select name="level" id="level" class="form-select" required>
                <option value="Administrator" @if($user->level == 'Administrator') selected @endif>Administrator</option>
                <option value="User" @if($user->level == 'User') selected @endif>User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update User</button>
    </form>
</div>
@endsection
