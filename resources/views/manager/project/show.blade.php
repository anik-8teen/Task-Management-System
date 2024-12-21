@extends('include.app')

@section('content')
    <div class="container mt-4">
        <!-- Project Details -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h3 class="card-title">{{ $project->name }}</h3>
                <p class="card-text">
                    <strong>Project Code:</strong> {{ $project->project_code }} <br>
                    <strong>Status:</strong>
                    <span
                        class="badge 
                    {{ $project->status == 0 ? 'bg-secondary' : ($project->status == 1 ? 'bg-info' : 'bg-success') }}">
                        {{ $project->status == 0 ? 'Pending' : ($project->status == 1 ? 'On Progress' : 'Completed') }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Tasks Section -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tasks</h5>
                @if(Auth::user()->role=='manager')
                <a href="{{ route('task.create', $project->id) }}" class="btn btn-primary btn-sm">Add Task</a>
                @endif
            </div>
            <div class="card-body">
                @if ($tasks->isEmpty())
                    <p class="text-muted">No tasks available for this project.</p>
                @else
                    <div class="row">
                        @foreach ($tasks as $task)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <strong>{{ $task->task_name }}</strong>
                                        <span
                                            class="badge 
                                            {{ $task->status == 0 ? 'bg-secondary' : ($task->status == 1 ? 'bg-info' : 'bg-success') }}">
                                            {{ $task->status == 0 ? 'Pending' : ($task->status == 1 ? 'In Progress' : 'Completed') }}
                                        </span>
                                    </div>

                                    <div class="card-body">
                                        <p class="mb-0 text-muted">{{ $task->description }}</p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                        @if(Auth::user()->role=='manager')
                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
