<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ManageTaskController;
use App\Http\Controllers\Admin\ActivityLogController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::group(['middleware' => RedirectIfAuthenticated::class], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('admin/users/{userId}/update-role', [UserController::class, 'updateUserRole'])->name('admin.users.updateRole');
    Route::get('/admin/manage-task', [ManageTaskController::class, 'index'])->name('admin.manageTask.index');
    Route::get('/admin/manage-task', [ManageTaskController::class, 'index'])->name('admin.manageTask.index');
    Route::get('/admin/manage-task/{id}/edit', [ManageTaskController::class, 'edit'])->name('admin.manageTask.edit');
    Route::put('/admin/manage-task/{id}', [ManageTaskController::class, 'update'])->name('admin.manageTask.update');
    Route::delete('/admin/manage-task/{id}', [ManageTaskController::class, 'destroy'])->name('admin.manageTask.destroy');
    Route::post('/admin/manage-task/{id}/completed', [ManageTaskController::class, 'markCompleted'])->name('admin.manageTask.markCompleted');
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activityLogs.index');
    Route::delete('/admin/users/{userId}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', CheckRole::class . ':regular_user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/task/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{id}', [TaskController::class, 'destroy'])->name('task.delete');
    Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('task.complete');
});