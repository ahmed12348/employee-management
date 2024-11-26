@extends('admin.layout')

@section('title', 'Create User')

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
            <h5 class="mb-4">Create New User</h5>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" 
                            value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" 
                            value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select">
                            <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                            <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" step="0.01" name="salary" id="salary" class="form-control" value="{{ old('salary') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="department_id" class="form-label">Department</label>
                        <select name="department_id" id="department_id" class="form-select">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="manager_id" class="form-label">Manager</label>
                        <select name="manager_id" id="manager_id" class="form-select">
                            <option value="">Select Manager</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                                    {{ $manager->first_name }} {{ $manager->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                </div>
            
               
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-3">Cancel</a>
                    <button type="submit" class="btn btn-success">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
