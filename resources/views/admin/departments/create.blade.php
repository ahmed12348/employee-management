@extends('admin.layout')

@section('title', 'Add Department')

@section('content')
<div class="container">
    <!-- Breadcrumb Navigation -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Departments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">Departments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Department</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Add Department</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.departments.store') }}" method="POST">
                        @csrf
                        <!-- Department Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter department name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add Department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
