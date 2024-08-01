<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


//Projects

Route::post('/projects', [ProjectController::class, 'createProject'])->middleware('auth:sanctum');
Route::put('/projects/{id}', [ProjectController::class, 'updateProject'])->middleware('auth:sanctum');
Route::delete('/projects/{id}', [ProjectController::class, 'deleteProject'])->middleware('auth:sanctum');
Route::put('/projects/permissions/{id}', [ProjectController::class, 'updateUserProjectPermissions'])->middleware('auth:sanctum');

