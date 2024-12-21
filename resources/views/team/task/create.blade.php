@extends('include.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($task) ? route('task.update', $task->id) : route('task.store', $project->id) }}"
                method="POST">
                @csrf
                @if (isset($task))
                    @method('POST')
                @endif

                <!-- Task Name -->
                <div class="mb-3">
                    <label for="task_name" class="form-label">Task Name</label>
                    <input type="text" class="form-control @error('task_name') is-invalid @enderror" id="task_name"
                        name="task_name" value="{{ old('task_name', $task->task_name ?? '') }}" {{ Auth::user()->role == 'member' ? 'readonly' : 'required' }}>
                    @error('task_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="4" {{ Auth::user()->role == 'member' ? 'readonly' : '' }}>
                        {{ old('description', $task->description ?? '') }}
                    </textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                @if (Auth::user()->role == 'manager')
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Assign to User</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id"
                            required>
                            <option value="" disabled selected>Select a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $task->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="0" {{ old('status', $task->status ?? '') == 0 ? 'selected' : '' }}>Pending
                        </option>
                        <option value="1" {{ old('status', $task->status ?? '') == 1 ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="2" {{ old('status', $task->status ?? '') == 2 ? 'selected' : '' }}>Completed
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($task) ? 'Update Task' : 'Create Task' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
