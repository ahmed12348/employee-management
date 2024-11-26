@extends('admin.layout')

@section('title', 'Edit User')

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
                <h5 class="mb-4">Edit User</h5>
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" 
                                value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" 
                                value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option selected disabled>Select Role</option>
                                <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" id="department_id" name="department_id">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" 
                                        {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-3">Cancel</a>
                        <button type="submit" class="btn btn-success">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
