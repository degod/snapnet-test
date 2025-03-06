<?php

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('project')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('view.projects');
    Route::get('/{project}/show', [ProjectController::class, 'show'])->name('view.project-details');
});

Route::prefix('task')->group(function () {
    Route::get('/create', [TaskController::class, 'createTask'])->name('create.task');
    Route::post('/create', [TaskController::class, 'storeTask'])->name('create.task-action');
    Route::get('/{task}/edit', [TaskController::class, 'editTask'])->name('edit.task');
    Route::post('/{task}/edit', [TaskController::class, 'updateTask'])->name('edit.task-action');
});
