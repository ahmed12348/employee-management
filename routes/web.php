<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// , 'role:admin'a
// Routes for authenticated users with the /dashboard prefix Authentication Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Default dashboard route
 

    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::resource('users', UserController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('tasks', TaskController::class);

});

// Route::prefix('admin')->middleware(['auth'])->group(function () {
    
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');

//     Route::resource('users', UserController::class)->names('admin.users');
//     Route::resource('departments', DepartmentController::class)->names('admin.departments');
//     Route::resource('tasks', TaskController::class)->names('admin.tasks');
// });




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
