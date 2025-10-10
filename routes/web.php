<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
// CRUDに関するルーティングをまとめて設定
Route::resource('posts', PostController::class)->except(['index']);
Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);