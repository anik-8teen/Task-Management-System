@extends('include.app')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center">
                <h4 class="mb-0">Teammates List</h4>
                <a href="{{ route('user.create') }}" class="btn btn-dark ms-auto">Add Member</a>
            </div>            
            <div class="card-body">
                @if ($users->isEmpty())
                    <p class="text-center">No teammates found.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role ?? 'N/A' }}</td>
                                    <td>
                                 
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
