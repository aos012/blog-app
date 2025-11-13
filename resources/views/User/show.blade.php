<x-layout>
    <x-slot:title>
        ユーザープロフィール・blog
    </x-slot>

    <h1>{{ $user->name }}</h1>
    <!-- プロフィール更新時メッセージ表示 -->
    @if(session('message'))
        {{ session('message')}}
    @endif
    <!-- 本人のみプロフィール編集リンクを表示 -->
    @can('profile-edit', $user)
        <a href="{{ route('user.edit', $user) }}">プロフィールを編集</a>
    @endcan    
    @if ($user->profile)
        <p>{!! nl2br(e($user->profile)) !!}</p>
    @else <!-- プロフィール未記入の場合 -->
        <p>プロフィールは記入されていません</p>
    @endif
    <h2>投稿一覧</h2>
    <!-- 投稿をループで表示 -->
    @forelse ($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            <p>{{ $post->created_at }}</p>
        </li>
    @empty <!-- 投稿がない場合 -->
        <li>投稿された記事はありません</li>
    @endforelse
    <a href="{{ url()->previous() }}">戻る</a>
    
</x-layout>