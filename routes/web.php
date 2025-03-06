<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('project')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('view.projects');
    Route::get('/{project}/show', [ProjectController::class, 'show'])->name('view.project-details');
});
