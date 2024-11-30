<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);

Route::get('/', function () {
    return view('welcome');
});
// autentikasi dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/projects', function () {
    return view('projects.index');
})->middleware(['auth'])->name('projects.index');

Route::get('/profil', function () {
    return view('profil');
})->middleware(['auth'])->name('profil');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
// endof autentikasi dashboard

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route untuk projectController
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

// Route untuk Taskcontroller
Route::put('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::put('/tasks/{task}', [ProjectController::class, 'update'])->name('tasks.update');

// Route DashboardController
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';
