@extends('admin.layout')

@section('title', 'Departments List')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Departments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Departments List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
        @if (auth()->user()->role === 'manager')
            <div class="btn-group">
                <a class="btn btn-success" href="{{ route('admin.departments.create') }}">Create New Department</a>
            </div>
            @endif
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Departments</h5>
                <form class="ms-auto position-relative" method="GET" action="{{ route('admin.departments.index') }}">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control ps-5" type="text" name="search" placeholder="Search" value="{{ request()->query('search') }}">
                </form>
            </div>

            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Total Salary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>${{ number_format($department->total_salary, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.departments.edit', $department->id) }}" class="text-warning">
                                    <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger"
                                                @if($department->users->count() > 0) disabled @endif>
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
