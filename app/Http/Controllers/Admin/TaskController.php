<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepo;
    protected $userRepo;

    public function __construct(TaskRepository $taskRepo, UserRepository $userRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->userRepo = $userRepo;
    }

    // Show a list of tasks assigned to a manager
    public function index()
    {
        $user = auth()->user(); // Get the currently authenticated user
        $isManager = $user->role === 'manager'; // Check if the user is a manager
        $tasks = $this->taskRepo->getTasksByManager($user->id, $isManager);
        return view('admin.tasks.index', compact('tasks'));

    }

    // Create a new task
    public function create()
    {
        $employees = $this->taskRepo->getEmployeesUnderManager(auth()->id());
        return view('admin.tasks.create', compact('employees'));
    }

    // Store a new task
    public function store(Request $request)
    {
        $managerId = auth()->id();

        $request->validate([
            'title' => 'required|max:255',
            'employee_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) use ($managerId) {
                    $employees = $this->taskRepo->getEmployeesUnderManager($managerId)->pluck('id');
                    if (!$employees->contains($value)) {
                        $fail('The selected employee is not under your management.');
                    }
                },
            ],
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
        // return $request->all();
        // Include the manager ID in the task data
        $data = $request->all();
        $data['manager_id'] = $managerId;

        $this->taskRepo->createTask($data);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit($id)
{
    $employees = $this->taskRepo->getEmployeesUnderManager(auth()->id());
    $user = auth()->user();
    $task = $this->taskRepo->getTaskById($id);

    // Check if the user is authorized to edit the task
    if (($user->role === 'manager' && $task->manager_id === $user->id) ||
        ($user->role === 'employee' && $task->employee_id === $user->id)) {
        return view('admin.tasks.edit', compact('task','employees'));
    }

    // Unauthorized access
    abort(403, 'You are not authorized to edit this task.');
}

    // Update a task
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'nullable',
            'employee_id' => 'required|exists:users,id',
        ]);

        $this->taskRepo->updateTask($id, $request->all());

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete a task
    public function destroy($id)
    {
        $this->taskRepo->deleteTask($id);
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
}

