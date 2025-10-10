<x-layout>
    <x-slot:title>
        blog
    </x-slot>
    <h1>記事一覧</h1>
    <a href="{{ route('posts.create') }}">新しい投稿を作成</a>
    <ul>
        <!-- 投稿をループで表示 -->
        @forelse ($posts as $post)
        <li><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></li>
        @empty <!-- 投稿がない場合 -->
        <li>投稿された記事はありません</li>
        @endforelse
    </ul>
</x-layout>