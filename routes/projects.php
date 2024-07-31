<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Projects

Route::post('/projects', [ProjectController::class, 'createProject'])->middleware('auth:sanctum');

