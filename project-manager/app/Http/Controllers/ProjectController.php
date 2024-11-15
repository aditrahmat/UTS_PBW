<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $projects = Project::with('tasks')->get();

    foreach ($projects as $project) {
        // Hitung jumlah task yang selesai dan total task
        $completedTasks = $project->tasks->where('status', 'Completed')->count();
        $totalTasks = $project->tasks->count();

        // Hitung progress sebagai persentase dan update kolom progress
        $project->progress = $totalTasks > 0 ? intval(($completedTasks / $totalTasks) * 100) : 0;

        // Update status project berdasarkan progress
        if ($project->progress == 100) {
            $project->status = 'Completed';
        } elseif ($project->progress > 0) {
            $project->status = 'In Progress';
        } else {$project->progress == 0;
            $project->status = 'Not Started';
        }

        $project->save();
    }

    return view('projects.index', compact('projects'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi data proyek
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|string|in:Not Started,In Progress,Completed',
        
        // Validasi untuk tasks
        'task_name' => 'array|required',
        'task_name.*' => 'required|string|max:255',
        'assigned_to' => 'array|required',
        'assigned_to.*' => 'required|string|max:255',
        'task_status' => 'array|required',
        'task_status.*' => 'required|string|in:Pending,Completed',
        'due_date' => 'array|nullable',
        'due_date.*' => 'nullable|date',
    ]);

    // Simpan data proyek
    $project = Project::create([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        'start_date' => $validatedData['start_date'],
        'end_date' => $validatedData['end_date'],
        'status' => $validatedData['status'], // Ambil status proyek saja
    ]);

    // Simpan data tasks yang terkait dengan proyek
    $tasks = [];
    foreach ($validatedData['task_name'] as $index => $taskName) {
        $tasks[] = [
            'project_id' => $project->id,
            'task_name' => $taskName,
            'assigned_to' => $validatedData['assigned_to'][$index],
            'status' => $validatedData['task_status'][$index], // Gunakan task_status untuk setiap task
            'due_date' => $validatedData['due_date'][$index] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    // Gunakan Eloquent untuk menyimpan semua tasks sekaligus
    Task::insert($tasks);

    return redirect()->route('projects.index')->with('success', 'Proyek dan tugas berhasil disimpan!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projects = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::findOrFail($id);
        return view('projects.edit', compact('projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|string|in:Not Started,In Progress,Completed',
    ]);

    // Update project
    $project = Project::findOrFail($id);
    $project->update($validatedData);

    // Get task inputs
    $taskIds = $request->input('task_id', []);
    $taskNames = $request->input('task_name', []);
    $assignedTo = $request->input('assigned_to', []);
    $taskStatuses = $request->input('task_status', []);
    $dueDates = $request->input('due_date', []);

    // Get IDs of existing tasks in the database for this project
    $existingTaskIds = $project->tasks()->pluck('id')->toArray();

    // Loop over each task in the form data
    foreach ($taskNames as $index => $taskName) {
        if (!empty($taskIds[$index]) && in_array($taskIds[$index], $existingTaskIds)) {
            // Update existing task
            $task = Task::findOrFail($taskIds[$index]);
            $task->update([
                'task_name' => $taskName,
                'assigned_to' => $assignedTo[$index],
                'status' => $taskStatuses[$index],
                'due_date' => $dueDates[$index],
            ]);
        } else {
            // Create new task if task ID is empty
            $project->tasks()->create([
                'task_name' => $taskName,
                'assigned_to' => $assignedTo[$index],
                'status' => $taskStatuses[$index],
                'due_date' => $dueDates[$index],
            ]);
        }
    }

    // Delete tasks that were not in the submitted task IDs
    $tasksToDelete = array_diff($existingTaskIds, $taskIds);
    Task::whereIn('id', $tasksToDelete)->delete();

    return redirect()->route('projects.index')->with('success', 'Proyek dan tugas berhasil diperbarui!');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();
        return redirect()->route('projects.index')->with('success', 'project berhasil dihapus.');
    }
}
