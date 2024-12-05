<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil pengguna yang sedang login
        

        if ($user->level === 'Administrator') {
            // Data khusus admin
            $projects = Project::all();
            $totalProjects = Project::count();
            $tasksCompleted = Task::where('status', 'completed')->count();
            $upcomingTasks = Task::where('due_date', '>=', now())->count();

            // Kirim data ke tampilan admin
            return view('admin.dashboard', compact('projects', 'totalProjects', 'tasksCompleted', 'upcomingTasks'));
        }

        if ($user->level === 'User') {
            // Data khusus user biasa
            $projects = Project::where('id', $user->id)->get(); // Ambil proyek milik user
            $totalProjects = $projects->count();
            $tasksCompleted = Task::where('id', $user->id)->where('status', 'completed')->count();
            $upcomingTasks = Task::where('id', $user->id)->where('due_date', '>=', now())->count();

            // Kirim data ke tampilan user
            return view('dashboard.user', compact('projects', 'totalProjects', 'tasksCompleted', 'upcomingTasks'));
        }

        // Tampilan default jika role tidak terdefinisi
        return view('dashboard.default')->with('message', 'Your role is not defined.');
    }
}
