<?php

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

// Dashboard - accessible to all authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Profile routes (for all users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';

// Project Routes
Route::prefix('project')->middleware('auth')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('view.projects');

    Route::get('/{project}/show', [ProjectController::class, 'show'])
        ->name('view.project-details');

    // Admin-only project management
    Route::middleware('role:admin')->group(function () {
        Route::get('/create', [ProjectController::class, 'create'])->name('create.project');
        Route::post('/create', [ProjectController::class, 'store'])->name('store.project');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit.project');
        Route::patch('/{project}', [ProjectController::class, 'update'])->name('update.project');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('delete.project');
    });
});

// Task Routes
Route::prefix('task')->middleware('auth')->group(function () {
    Route::get('/create', [TaskController::class, 'createTask'])->name('create.task');
    Route::post('/create', [TaskController::class, 'storeTask'])->name('create.task-action');

    Route::middleware('role:admin')->group(function () {
        Route::get('/{task}/edit', [TaskController::class, 'editTask'])->name('edit.task');
        Route::post('/{task}/edit', [TaskController::class, 'updateTask'])->name('edit.task-action');
        Route::delete('/{task}', [TaskController::class, 'destroyTask'])->name('delete.task');
    });
});
