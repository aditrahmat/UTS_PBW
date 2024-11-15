<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Proyek')</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/vapor.bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('../../projects') }}">Project Management Apps</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('dashboard')) active @endif" href="{{ url('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('projects*')) active @endif" href="{{ url('/projects') }}">Projects</a>
                    </li>
                    <li class="nav-item">
                    <!-- Tombol Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display: inline; cursor: pointer;">Logout</button>
                    </form>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Manager Aplikasi. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
