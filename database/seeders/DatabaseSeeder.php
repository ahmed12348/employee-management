<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Departments
        $departments = Department::factory()->count(3)->create();

        // Create Managers and Employees
        foreach ($departments as $department) {
            // Create a Manager for each department
            $manager = User::create([
                'first_name' => 'Manager_' . $department->name,
                'last_name' => 'Manager_LastName',
                'email' => 'manager_' . $department->name . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'salary' => '100',
                'department_id' => $department->id,
            ]);

            // Create Employees for each department
            $employees = User::factory()->count(5)->create([
                'role' => 'employee',
                'department_id' => $department->id,
                'manager_id' => $manager->id,
            ]);

            // Assign tasks to employees by the manager
            foreach ($employees as $employee) {
                Task::create([
                    'title' => 'Task for ' . $employee->first_name,
                    'description' => 'Description of task for ' . $employee->first_name,
                    'status' => 'pending',
                    'employee_id' => $employee->id,
                    'manager_id' => $manager->id,
                ]);
            }
        }

        // Additional tasks to cover edge cases
        $otherManager = User::create([
            'first_name' => 'OtherManager',
            'last_name' => 'Manager_LastName',
            'email' => 'other_manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'salary' => '10',
        ]);

        $otherEmployee = User::create([
            'first_name' => 'OtherEmployee',
            'last_name' => 'Employee_LastName',
            'email' => 'other_employee@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'salary' => '13',
            'manager_id' => $otherManager->id,
        ]);

        Task::create([
            'title' => 'Unrelated Task',
            'description' => 'This is a task for unrelated testing',
            'status' => 'in_progress',
            'employee_id' => $otherEmployee->id,
            'manager_id' => $otherManager->id,
        ]);
    }
}
