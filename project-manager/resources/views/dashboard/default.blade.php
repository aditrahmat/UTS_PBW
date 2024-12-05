<!-- resources/views/dashboard/default.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Dashboard</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" level="alert">
                        {{ $message ?? 'Your level is not defined. Please contact the administrator.' }}
                    </div>
                    <p class="mb-0">
                        It seems like your level has not been defined properly. Please log out and contact support for assistance.
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('logout') }}" 
                       class="btn btn-danger" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
