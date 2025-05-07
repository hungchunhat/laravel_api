<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/add/post', [PostController::class, 'addPost'])->middleware('auth:sanctum');
Route::patch('/edit/post/{post}', [PostController::class, 'editPost'])->middleware('auth:sanctum');
Route::get('/posts', [PostController::class, 'getAllPost']);
Route::get('/post/{id}', [PostController::class, 'getPost']);
Route::delete('/delete/post/{id}', [PostController::class, 'deletePost'])->middleware('auth:sanctum');

Route::post('/comment', [CommentController::class, 'postComment'])->middleware('auth:sanctum');
Route::post('/like', [LikeController::class, 'likePost'])->middleware('auth:sanctum');
Route::delete('/unlike', [LikeController::class, 'unLikePost'])->middleware('auth:sanctum');
