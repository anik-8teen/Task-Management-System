<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id)->paginate(15);
        return view('manager.project.index', compact('projects'));
    }


    public function create()
    {
        return view('manager.project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $projectCode = $this->generateProjectCode($request->name);

        $project = new Project();
        $project->name = $request->name;
        $project->project_code = $projectCode;
        $project->user_id = Auth::id();
        $project->status = 0;
        $project->save();

        return redirect()->route('project.index')->with('success', 'Project created successfully.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {

        $project = Project::findOrFail($id);
        return view('manager.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project = Project::findOrFail($id);

        if ($project->user_id !== auth()->id()) {
            return redirect()->route('projects.index')->with('error', 'You are not authorized to edit this project.');
        }

        $projectCode = $this->generateProjectCode($request->name);

        $project = Project::find($id);
        if ($project) {
            $project->name = $request->name;
            $project->project_code = $projectCode;
            if ($request->status) {
                $project->status = $request->status;
            }
            $project->save();
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }


    private function generateProjectCode($name)
    {
        $nameSlug = Str::slug($name);
        $uniqueNumber = rand(1000, 9999);
        return strtoupper($nameSlug . '-' . $uniqueNumber);
    }

    public function destroy(string $id)
    {
        
    }
}
