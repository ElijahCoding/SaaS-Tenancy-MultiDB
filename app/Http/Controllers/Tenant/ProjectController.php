<?php

namespace App\Http\Controllers\Tenant;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        // $projects = cache()->remember('projects', 10, function () {
        //     return Project::get();
        // });
        $projects = Project::get();
        return view('tenant.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('tenant.projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Project::create([
            'name' => $request->name
        ]);

        return back();
    }
}
