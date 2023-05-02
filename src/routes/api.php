<?php

use App\Http\Controllers\Auth\AuthApiController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('login', [AuthApiController::class, 'login']);
Route::post('register', [AuthApiController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function () {
    
    // Auth
    Route::get('logout', [AuthApiController::class, 'logout']);
    Route::post('refresh', [AuthApiController::class, 'refresh']);
    
    // Projets
    Route::resource('projects', ProjectController::class);
    
    // Tasks
    Route::resource('tasks', TaskController::class);
    
    // TaskUser
    Route::resource('task-user', TaskUserController::class);
});