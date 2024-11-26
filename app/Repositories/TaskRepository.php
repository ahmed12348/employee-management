<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;

class TaskRepository
{
    // Get all tasks for a manager
    public function getTasksByManager($userId,$isManager)
    {
      
        if ($isManager) {
            // Manager: Get tasks assigned to employees under this manager
            return Task::where('manager_id', $userId)->with('employee')->get();
        } else {
            // Employee: Get tasks assigned to this employee
            return Task::where('employee_id', $userId)->with('employee')->get();
        }
    }

    // Assign a task to an employee
    public function createTask(array $data)
    {
        return Task::create($data);
    }

    // Update a task
    public function updateTask($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    // Delete a task
    public function deleteTask($id)
    {
        return Task::destroy($id);
    }
      // Get employees under a manager
      public function getEmployeesUnderManager($managerId)
      {
          return User::where('manager_id', $managerId)
            //   ->orWhereHas('department', function ($query) use ($managerId) {
            //       $query->where('manager_id', $managerId);
            //   })
              ->get();
      }
      public function getTaskById($id)
        {
            return Task::with('employee')->findOrFail($id);
        }
}
