<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Organizer</title>
    <link href="{{ asset('css/vapor.bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    @include('partials.navbar') <!-- Navbar Include -->
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <p class="lead">Let's organize your projects</p>
        
        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Projects</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalProjects }}</h5>
                        <p class="card-text">All projects in the system.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Tasks Completed</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $tasksCompleted }}</h5>
                        <p class="card-text">Tasks successfully completed.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Upcoming Deadlines</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $upcomingTasks }}</h5>
                        <p class="card-text">Tasks with approaching deadlines.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tautan Cepat -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('projects.create') }}" class="btn btn-outline-primary">Add New Project</a>
        </div>

        <!-- Daftar Proyek -->
        <div class="mt-5">
            <h3>Active Projects</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>
                        <td>
                            <a href="{{ route('projects.index', $project->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No projects found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
