<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\TaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }


    public function boot()
    {
        //
    }

}