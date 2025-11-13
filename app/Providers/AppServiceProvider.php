<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Postの編集・削除権限
        Gate::define('post-operation', function (User $user, Post $post){
            if ($user->id === $post->user_id) {
                return true;
            }
            return false;
        }); 

        //Commentの削除権限
        Gate::define('comment-operation', function (User $user, Comment $comment){
            if ($user->id === $comment->user_id) {
                return true;
            }
            return false;
        });
        //プロフィール編集権限
        Gate::define('profile-edit', function (User $loginUser, User $profileUser){
            if ($loginUser->id === $profileUser->id) {
                return true;
            }
            return false;
        }); 
    }
}
