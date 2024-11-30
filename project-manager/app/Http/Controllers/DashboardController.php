<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; // Import model Project
use App\Models\Task;    // Import model Task

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik
        $projects = Project::all();
        $totalProjects = $projects->count();
        $tasksCompleted = Task::where('status', 'completed')->count();
        $upcomingTasks = Task::where('due_date', '>=', now())->count();

        // Kirim data ke view
        return view('dashboard', compact('projects', 'totalProjects', 'tasksCompleted', 'upcomingTasks'));
    }
}
