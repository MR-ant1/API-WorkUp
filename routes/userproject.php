<?php

use App\Http\Controllers\UserProjectController;
use Illuminate\Support\Facades\Route;


//Projects

Route::post('/userProject/{id}', [UserProjectController::class, 'addUserToProject'])->middleware('auth:sanctum');
