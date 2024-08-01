<?php

use App\Http\Controllers\UserProjectController;
use Illuminate\Support\Facades\Route;


//Projects

Route::get('/userProject', [UserProjectController::class, 'getMyProjects'])->middleware('auth:sanctum');
Route::post('/userproject/{id}', [UserProjectController::class, 'addUserToProject'])->middleware('auth:sanctum');

