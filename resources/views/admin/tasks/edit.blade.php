@extends('admin.layout')

@section('title', 'Edit Task')

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
            <h5 class="mb-4">Edit Task</h5>
            <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="title">Task Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $task->title }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control">{{ $task->description }}</textarea>
                    </div>
                </div>
            

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="employee_id">Assign to Employee</label>
                        <select id="employee_id" name="employee_id" class="form-control" required>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="status">Task Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
