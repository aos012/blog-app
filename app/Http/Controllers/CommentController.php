<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    //新規コメントをDBに保存
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => 'required',
        ]);

        $validated['user_id'] = auth()->id();
        
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $post->id;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('posts.show', $post);
    }
    //削除処理
    public function destroy(Post $post, Comment $comment)
    {
        //投稿とユーザーidが一致しているユーザーのみ削除可能に
        Gate::authorize('comment-operation', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $post);
    }
}
