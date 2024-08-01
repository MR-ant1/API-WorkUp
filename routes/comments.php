<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;


//Projects

Route::post('/comments/{id}', [CommentController::class, 'createComment'])->middleware('auth:sanctum');
