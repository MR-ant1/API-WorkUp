<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//USERS

Route::put('/users/role/{id}', [UserController::class, 'updateUserRole'])->middleware('auth:sanctum')->middleware('admin');

