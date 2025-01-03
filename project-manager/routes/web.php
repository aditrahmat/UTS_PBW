<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// Step 1 : Register -> Verify
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Buat view ini
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// ==================================================================================================

// Step 2 user login action
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// ==================================================================================================

// ==================================================================================================
// =============== Route Level ====================== //

// Routes users as Administrator
Route::middleware(['auth', 'level:Administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    // Edit pengguna
    Route::resource('users', AdminUserController::class);
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');

    // Hapus pengguna
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});
// endof user as Administrator


// =============== Endof Route Level ====================== //
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);

Route::get('/', function () {
    return view('welcome');
});
// autentikasi dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

require __DIR__.'/auth.php';
