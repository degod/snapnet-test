<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $projects = Project::orderBy('id', 'DESC')->paginate(10);
        } else {
            $projects = Project::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        if (Auth::user()->role !== 'admin') {
            $project->load(['tasks' => function ($query) {
                $query->where('user_id', Auth::id());
            }]);
        }
        return view('projects.show', compact('project'));
    }
}
