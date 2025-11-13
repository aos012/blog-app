<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{
    //記事一覧画面
    public function index()
    {
        //投稿日時を新しい順に並べ替えペジネーションで10件ごとに取得
        $posts = Post::orderBy('created_at', 'desc')->with('user')->paginate(10);
        return view('index')->with(['posts' => $posts]);
    }

    //個別記事画面
    public function show(Post $post) 
    {
        return view('posts.show')->with(['post' => $post]);
    }
    //新規記事作成画面
    public function create() 
    {
        return view('posts.create');
    }
    //新規記事をデータベースに保存
    public function store(PostRequest $request) 
    {
        //ログイン中のユーザーidを渡す
        $validated['user_id'] = auth()->id();

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->id(); 
        $post->save();


        return redirect()->route('posts.index')->with('message', '記事を投稿しました。');
    }
    //記事内容更新画面
    public function edit(Post $post) 
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    //更新内容を保存
    public function update(PostRequest $request, Post $post) 
    {
        //投稿とユーザーidが一致しているユーザーのみ更新可能に
        Gate::authorize('post-operation', $post);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route('posts.show', $post)->with('message', '記事を更新しました。');
    }
    //記事の削除処理
    public function destroy(Post $post)
    {
        //投稿とユーザーidが一致しているユーザーのみ削除可能に
        Gate::authorize('post-operation', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('message', '記事を削除しました。');
    }
}
