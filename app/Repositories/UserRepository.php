<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    // Get all users with optional filters
    // public function getAllUsers($filters = [])
    // {
    //     $query = User::query();

    //     if (!empty($filters['role'])) {
    //         $query->where('role', $filters['role']);
    //     }

    //     if (!empty($filters['department_id'])) {
    //         $query->where('department_id', $filters['department_id']);
    //     }

    //     return $query->with('department', 'manager')->get();
    // }

    public function getAllUsers($filters = [], $managerId = null)
{
    $query = User::query();

    // Apply role filter
    if (!empty($filters['role'])) {
        $query->where('role', $filters['role']);
    }

    // Apply department filter
    if (!empty($filters['department_id'])) {
        $query->where('department_id', $filters['department_id']);
    }

    // Apply manager filter (restricting employees to a specific manager)
    if ($managerId) {
        $query->where('manager_id', $managerId);
    }

    // Apply search filter
    if (!empty($filters['search'])) {
        $query->where(function ($query) use ($filters) {
            $query->where('first_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('last_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%');
        });
    }

    // Eager load relationships
    return $query->with('department', 'manager')->get();
}
    // Get all managers
    public function getAllManagers()
    {
        return User::where('role', 'manager')->get();
    }

    // Get employees of a specific manager
    public function getEmployeesOfManager($managerId)
    {
        return User::where('manager_id', $managerId)->with('department')->get();
    }

    // Find a user by ID
    public function findUserById($id)
    {
        return User::with('department', 'manager')->findOrFail($id);
    }

    // Create a new user
    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    // Update a user
    public function updateUser($id, array $data)
    {
        $user = $this->findUserById($id);
    
        // Encrypt password if provided
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Don't update the password if it's not provided
        }
    
        // Update the user with the provided data
        $user->update($data);
    
        return $user;
    }

    // Delete a user
    public function deleteUser($id)
    {
        return User::destroy($id);
    }
}
