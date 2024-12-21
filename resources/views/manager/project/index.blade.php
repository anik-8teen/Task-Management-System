@extends('include.app')

@section('content')
    <div class="container mt-4">
        @if (Auth::user()->role == 'manager')
            <div class="mb-3">
                <a href="{{ route('project.create') }}" class="btn btn-outline-info btn-sm">Create Project</a>
            </div>
        @endif
        <div class="row">
            @forelse ($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">
                                <strong>Project Code:</strong> {{ $project->project_code }} <br>
                                <strong>Status:</strong>
                                <span
                                    class="badge 
                                    {{ $project->status == 0 ? 'bg-secondary' : ($project->status == 1 ? 'bg-info' : 'bg-success') }}">
                                    {{ $project->status == 0 ? 'Pending' : ($project->status == 1 ? 'On Progress' : 'Completed') }}
                                </span>
                            </p>
                            @if (Auth::user()->role == 'manager')
                            <a href="{{ route('project.edit', $project->id) }}" class="btn btn-info">Edit</a>
                            @endif
                            <a href="{{ route('project.show', $project->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    <h3>No Projects Created</h3>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
@endsection
