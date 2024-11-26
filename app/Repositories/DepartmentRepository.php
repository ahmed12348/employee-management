<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentRepository
{
    // Get all departments
    // public function getAllDepartments()
    // {
    //     return Department::with('users')->get();
    // }
    public function getAllWithTotalSalaries(): Collection
    {
        return Department::with('users')->get()->map(function ($department) {
            $department->total_salary = $department->users->sum('salary');
            return $department;
        });
    }

    public function getDepartmentById($id)
    {
        return Department::findOrFail($id);
    }
    
    // Create or update a department
    public function saveDepartment(array $data, $id = null)
    {
        if ($id) {
            return Department::where('id', $id)->update($data);
        }

        return Department::create($data);
    }

    // Check if a department has employees
    public function hasEmployees($departmentId)
    {
        return Department::find($departmentId)->users()->exists();
    }

    // Delete a department
    public function deleteDepartment($id)
    {
        return Department::destroy($id);
    }
}
