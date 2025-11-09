<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('user.show')->with(['posts' => $posts, 'user' => $user]);
    }
}
