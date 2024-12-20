<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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
    Route::get('manager/project/index', [ProjectController::class, 'index'])->name('project.index');
    Route::get('manager/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('manager/project/store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('manager/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('manager/project/update/{id}', [ProjectController::class, 'update'])->name('project.update');
});
