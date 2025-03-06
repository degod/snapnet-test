<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
