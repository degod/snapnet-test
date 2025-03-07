<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'You do not have permission to view this page.');
        }

        $jobs = DB::table('failed_jobs')->orderBy('id', 'DESC')->paginate(10);

        return view('admin.jobs', compact('jobs'));
    }
}
