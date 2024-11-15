<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ asset('css/vapor.bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    @include('partials.navbar') <!-- Navbar Include -->
    <div class="container mt-5">
        <h1>Welcome to the Dashboard</h1>
        <p>This is your main dashboard page.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>