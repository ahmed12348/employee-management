@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Task</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">tasks List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            @if (auth()->user()->role === 'manager')
            <div class="btn-group">
                <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">Create New task</a>
            </div>
            @endif

        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center">
                <h5 class="mb-0">Task</h5>
                <form class="ms-auto position-relative" method="GET" action="{{ route('admin.tasks.index') }}">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control ps-5" type="text" name="search" placeholder="Search"
                        value="{{ request()->query('search') }}">
                </form>
            </div>

            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                    <th>Task ID</th>
                    <th>Title</th>
                    <th>Assigned Employee</th>
                    <th>Status</th>
                    <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $index => $task)
                            <tr>
                            <td>{{ $task->id }}</td>
                           <td>{{ $task->title }}</td>
                           <td>{{ $task->employee->first_name }} {{ $task->employee->last_name }}</td>
                           <td>{{ $task->status }}</td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="text-warning">
                                    <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    @if (auth()->user()->role === 'manager')
                                            <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 text-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this tasks?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                     @endif 
                                     

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
