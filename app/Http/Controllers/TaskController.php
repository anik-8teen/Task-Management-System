<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $project = Project::find($id);
        $tasks = Task::where('project_id', $project->id)->get();
        return view('team.task.index', compact('tasks'));
    }


    public function create($id)
    {
        $project = Project::find($id);
        $users = User::where('role', 'member')->get();
        return view('team.task.create', compact('project', 'users'));
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|integer|in:0,1,2',
        ]);

        // Create the task
        $task = Task::create([
            'project_id' => $projectId,
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        $project = Project::find($task->project_id);

        $newTeamIds = $request->input('team_ids', []);
        $userId = $request->user_id;
        $updatedTeamIds = array_unique(array_merge($project->team_ids ?? [], $newTeamIds, [$userId]));
        $project->update(['team_ids' => $updatedTeamIds]);

        return redirect()->route('project.show', $projectId)->with('success', 'Task created successfully.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('role', 'member')->get();
        return view('team.task.create', compact('task', 'users'));
    }

    public function update(Request $request, $taskId)
    {

        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|integer|in:0,1,2',
        ]);


        $task = Task::findOrFail($taskId);


        $task->update([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('project.show', $task->project_id)->with('success', 'Task updated successfully.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();
        return redirect()->route('project.show', $task->project_id)->with('success', 'Task Deleted successfully.');
    }
}
