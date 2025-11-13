<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    //ユーザー詳細画面
    public function show(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->with('user')->paginate(10);

        return view('user.show')->with(['posts' => $posts, 'user' => $user]);
    }

    public function edit(User $user)
    {
        return view('user.edit')->with(['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        Gate::authorize('profile-edit', $user);

        $request->validate([
            'name' => 'required',
            'profile' => 'nullable|max:1000',
        ]);

        $user->name = $request->name;
        $user->profile = $request->profile;
        $user->save();

        return redirect()->route('user.show', $user)->with('message', 'プロフィールを更新しました。');
    }
}
