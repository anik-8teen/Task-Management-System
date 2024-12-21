<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
    //Project
    Route::middleware(['role:manager'])->group(function () {
        Route::get('manager/project/create', [ProjectController::class, 'create'])->name('project.create');
        Route::post('manager/project/store', [ProjectController::class, 'store'])->name('project.store');
        Route::get('manager/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::post('manager/project/update/{id}', [ProjectController::class, 'update'])->name('project.update');
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/users/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::delete('/tasks/delete/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

        Route::get('/projects/{projectId}/tasks/create', [TaskController::class, 'create'])->name('task.create');
        Route::post('/projects/{projectId}/tasks/store', [TaskController::class, 'store'])->name('task.store');
    });
    
    Route::get('manager/project/index', [ProjectController::class, 'index'])->name('project.index');
    Route::get('manager/project/show/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/projects/{projectId}/tasks', [TaskController::class, 'index'])->name('task.index');
    Route::get('/tasks/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/tasks/{id}', [TaskController::class, 'update'])->name('task.update');
});
