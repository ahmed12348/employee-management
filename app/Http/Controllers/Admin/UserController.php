<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Repositories\DepartmentRepository;
class UserController extends Controller
{
    protected $userRepo;
    protected $departmentRepo;
    public function __construct(UserRepository $userRepo, DepartmentRepository $departmentRepo)
    {
        $this->userRepo = $userRepo;
        $this->departmentRepo = $departmentRepo;
    }
    // Get all users (with optional filters for role and department)
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'manager') {
            // Get only employees assigned to the logged-in manager
            $filters = $request->only(['role', 'department_id']);
            $users = $this->userRepo->getAllUsers($filters, $user->id);
            return view('admin.users.index', compact('users'));
        }
    
        abort(403, 'Unauthorized access.');
        // $filters = $request->only(['role', 'department_id']);
        // $users = $this->userRepo->getAllUsers($filters);
        // return view('admin.users.index', compact('users'));
    }

    // Create a new user
    public function create()
    {
        // Get all departments
        $departments = $this->departmentRepo->getAllWithTotalSalaries(); // This uses your DepartmentRepository
        $managers = $this->userRepo->getAllManagers(); // Get all managers

        return view('admin.users.create', compact('departments', 'managers'));
    }

    // Store a new user
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'role' => 'required|in:employee,manager',
        'salary' => 'required',
        'department_id' => 'nullable|exists:departments,id',
        'manager_id' => 'nullable|exists:users,id',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',  // Ensure you have the confirmation field in your form
    ]);

    // Debugging the validated data to ensure the data is correct
    // dd($validatedData);

    try {
        $this->userRepo->createUser($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    } catch (\Exception $e) {
        // Catch any errors and display them
        return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
    }
}
    // Edit a user
    public function edit($id)
    {
        
        $user = $this->userRepo->findUserById($id);
        $departments = $this->departmentRepo->getAllWithTotalSalaries();
        $managers = $this->userRepo->getAllManagers();

    
        return view('admin.users.edit', compact('user', 'departments', 'managers'));
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'salary' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:employee,manager',
            'department_id' => 'nullable|exists:departments,id',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        $this->userRepo->updateUser($id, $request->all());

        return redirect()->route('admin.users.index');
    }

    // Delete a user
    public function destroy($id)
    {
        $this->userRepo->deleteUser($id);
        return redirect()->route('admin.users.index');
    }
}
