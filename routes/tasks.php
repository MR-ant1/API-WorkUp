<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


//Projects

Route::post('/tasks/{id}', [TaskController::class, 'createTask'])->middleware('auth:sanctum');
Route::put('/tasks/{id}', [TaskController::class, 'updateTask'])->middleware('auth:sanctum');
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask'])->middleware('auth:sanctum');
Route::put('/tasks/completed/{id}', [TaskController::class, 'markTaskCompleted'])->middleware('auth:sanctum');

