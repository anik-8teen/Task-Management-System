@extends('include.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        <h2>Welcome to Dashboard</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{route('project.index')}}" class="btn btn-outline-secondary">Manage Projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
