<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/dashboard', function () {
    return redirect()->route('posts.index'); 
})->middleware(['auth', 'verified'])
->name('dashboard');

Route::get('/', [PostController::class, 'index'])->middleware(['auth', 'verified'])
->name('posts.index');
// CRUDに関するルーティングをまとめて設定
Route::resource('posts', PostController::class)->except(['index']);
//コメント関連のルート
Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);
//breezeが自動生成したルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



