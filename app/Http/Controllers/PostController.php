<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //記事一覧画面
    public function index()
    {
        //投稿日時を新しい順に並べ替え取得
        $posts = Post::orderBy('created_at', 'desc')->get();
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
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
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
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route('posts.show', $post)->with('message', '記事を更新しました。');
    }
    //記事の削除処理
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('message', '記事を削除しました。');
    }
}
