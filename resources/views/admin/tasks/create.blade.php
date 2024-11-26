@extends('admin.layout')

@section('title', 'Create Task')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="mb-4">Create New Tasks</h5>
            <form action="{{ route('admin.tasks.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                    <label for="title">Task Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                </div>
            

                <div class="row mb-3">
                    <div class="col-md-6">
                    <label for="employee_id">Assign to Employee</label>
                    <select id="employee_id" name="employee_id" class="form-control" required>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
        @endforeach
    </select>
                    </div>

                    <div class="col-md-6">
                    <label for="status">Task Status</label>
                    <select id="status" name="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    </select>
                    </div>
                </div>

              

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary me-3">Cancel</a>
                    <button type="submit" class="btn btn-success">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
