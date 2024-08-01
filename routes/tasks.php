<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


//Projects

Route::post('/tasks/{id}', [TaskController::class, 'createTask'])->middleware('auth:sanctum');

