@extends('include.app')
@section('content')
    <form action="{{ route('project.update', $project->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}"
                required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="0" {{ old('status', $project->status) == 0 ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ old('status', $project->status) == 1 ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
@endsection
