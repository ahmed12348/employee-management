<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentRepo;
    protected $userRepo;

    public function __construct(DepartmentRepository $departmentRepo, UserRepository $userRepo)
    {
        $this->departmentRepo = $departmentRepo;
        $this->userRepo = $userRepo;
    }

    // Display a list of departments with total salaries
    // public function index(Request $request)
    // {
    //     $search = $request->query('search');

    //     $departments = $this->departmentRepo->getAllDepartments();

    //     // Filter departments based on search query
    //     if ($search) {
    //         $departments = $departments->filter(function ($department) use ($search) {
    //             return stripos($department->name, $search) !== false;
    //         });
    //     }

    //     return view('admin.departments.index', compact('departments'));
    // }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $departments = $this->departmentRepo->getAllWithTotalSalaries();

        if ($search) {
            $departments = $departments->filter(function ($department) use ($search) {
                return stripos($department->name, $search) !== false;
            });
        }

        return view('admin.departments.index', compact('departments'));
    }

    // Show the form to create a new department
    public function create()
    {
        return view('admin.departments.create');
    }

    // Store a new department
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name|max:255',
        ]);

        // Create new department using repository method
        $this->departmentRepo->saveDepartment($request->only('name'));

        return redirect()->route('admin.departments.index');
    }

    // Show the form to edit a department
    public function edit($id)
    {
        $department = $this->departmentRepo->getDepartmentById($id);

        if (!$department) {
            return redirect()->route('admin.departments.index');
        }

        return view('admin.departments.edit', compact('department'));
    }

    // Update a department
    public function update(Request $request, $id)
    {
        $department = $this->departmentRepo->getDepartmentById($id);

        if (!$department) {
            return redirect()->route('admin.departments.index');
        }

        $request->validate([
            'name' => 'required|max:255|unique:departments,name,' . $id,
        ]);

        // Update department using repository method
        $this->departmentRepo->saveDepartment($request->only('name'), $id);

        return redirect()->route('admin.departments.index');
    }

    // Delete a department
    public function destroy($id)
    {
        $department = $this->departmentRepo->getDepartmentById($id);

        if ($department && !$this->departmentRepo->hasEmployees($id)) {
            // If the department has no employees, delete it
            $this->departmentRepo->deleteDepartment($id);
        }

        return redirect()->route('admin.departments.index');
    }
}

