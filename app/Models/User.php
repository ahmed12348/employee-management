<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'mobile', 
        'salary', 
        'role', 
        'manager_id', 
        'department_id'
    ];

    // Relationship to department
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // Relationship to manager (self-referencing)
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Employees managed by this user (self-referencing)
    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    // Tasks assigned to the user
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'employee_id');
    }

    // Helper: Check if the user is an employee of a given manager
    public function isEmployeeOfManager($managerId): bool
    {
        return $this->manager_id === $managerId;
    }
}
