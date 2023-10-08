<?php

use Illuminate\Support\Facades\Route;
//Auth
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PcController;
use App\Http\Controllers\DefaultTaskController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\DeviceDefaultTaskController;
use App\Http\Controllers\AssignmentHistoryController;
use App\Http\Controllers\TaskHistoryController;
use App\Http\Controllers\DefaultTaskHistoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RepairObjectController;
use App\Http\Controllers\UsersController;
use App\Models\Repair_object;
use App\Models\User_role;

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

// Localized
Route::localized(function () {


    //Show Only Login Page
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::group(['middleware' => 'auth'], function () {    //Auth Users

        //Task
        Route::get('/task/history', [TaskController::class, 'history'])->name('task.history');
        Route::get('/task/show/{id?}', [TaskController::class, 'show'])->name('tasks.show');

        //Routes for index/home
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('home', [HomeController::class, 'index'])->name('home');



        //Assignment
        Route::resource('/assignment', AssignmentController::class);
        Route::get('/assignment/{query?}', [AssignmentController::class, 'index']);
        Route::post('/assignment/tasks/{assignment}', [AssignmentController::class, 'changeDone'])->name('assignment.changeDone');



        Route::resource('/news', NewsController::class);
        Route::resource('/workshop', WorkshopController::class);

        Route::resource('/task', TaskController::class);
        Route::get('/task/assignment/{assignment}', [TaskController::class, 'assignment'])->name('task.assignment');


        Route::resource('/pc', PcController::class);
        Route::resource('/default_task', DefaultTaskController::class);
        Route::resource('/user_role', UserRoleController::class);
        Route::resource('/device_default_task', DeviceDefaultTaskController::class);
        Route::resource('/assignment_history', AssignmentHistoryController::class);
        Route::resource('/task_history', TaskHistoryController::class);
        Route::resource('/default_task_history', DefaultTaskHistoryController::class);
        Route::resource('/note', NoteController::class);

        Route::resource('/repair_object', RepairObjectController::class);
        // Route::get('/repair_object/show/{id}', [RepairObjectController::class, 'show']);


        //Profile Management
        Route::get('/users/profile', [UsersController::class, 'edit'])->name('users.edit-profile');
        Route::put('/users/profile', [UsersController::class, 'update'])->name('users.update-profile');
        Route::post('/users/profile', [UsersController::class, 'updatePassword'])->name('users.update-password');

        //Auth
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


        //Admin Panel User Management
        Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {        //Admin Users

            //Settings user profile
            Route::get('/users', [UsersController::class, 'index'])->name('users');
            Route::put('/users', [UsersController::class, 'updateRole'])->name('users.update-permissions');
            Route::post('/users', [UsersController::class, 'store'])->name('users.store');
            Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

        });


        Route::group(['prefix' => 'technician', 'middleware' => 'isTechnician'], function () {        //Technician Users
            //
        });


        Route::group(['prefix' => 'supporter', 'middleware' => 'isSupporter'], function () {        //Supporter Users
            //
        });
    });
});
