<?php

use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Profile routes (for all users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Authentication routes
require __DIR__ . '/auth.php';

// Project Routes
Route::prefix('project')->middleware('auth')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('view.projects');
    Route::get('/{project}/show', [ProjectController::class, 'show'])->name('view.project-details');
});

// Task Routes
Route::prefix('task')->middleware('auth')->group(function () {
    Route::get('/create', [TaskController::class, 'createTask'])->name('create.task');
    Route::post('/create', [TaskController::class, 'storeTask'])->name('create.task-action');

    Route::get('/{task}/edit', [TaskController::class, 'editTask'])->name('edit.task');
    Route::post('/{task}/edit', [TaskController::class, 'updateTask'])->name('edit.task-action');
});

// AdminJob Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('view.failed-jobs');
});
