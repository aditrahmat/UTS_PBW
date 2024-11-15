<!-- resources/views/partials/navbar.blade.php -->
<link href="{{ asset('css/vapor.bootstrap.min.css') }}" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('profil')) active @endif" href="{{ route('profil') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('projects.index')) active @endif" href="{{ route('projects.index') }}">Project</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display: inline; cursor: pointer;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
