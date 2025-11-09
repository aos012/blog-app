<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::get('/dashboard', function () {
    return redirect()->route('posts.index'); 
})->name('dashboard');

Route::get('/', [PostController::class, 'index'])->name('posts.index');
// index,show以外のCRUDに関するルーティングをまとめて設定
Route::resource('posts', PostController::class)->except(['index', 'show'])
->middleware('auth');
//show
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
//コメント関連のルート
Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy'])->middleware('auth');
//ユーザー詳細ページ(そのユーザーの投稿一覧も表示)
Route::get('user/{user}', [UserController::class, 'show'])->name('user.show');
//breezeが自動生成したルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



