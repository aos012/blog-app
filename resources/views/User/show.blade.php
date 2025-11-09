<x-layout>
    <x-slot:title>
        ユーザープロフィール・blog
        </x-slot>
        <h1>{{ $user->name }}</h1>
        
            @if ($user->profile)
                <p>{{ $user->profile }}</p>
            @else <!-- プロフィール未記入 -->
                <p>プロフィールは記入されていません</p>
            @endif
        <h2>{{ $user->name }}さんの記事一覧</h2>
            <!-- 投稿をループで表示 -->
            @forelse ($posts as $post)
            <li><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a><p>{{ $post->created_at }}</p></li>
            @empty <!-- 投稿がない場合 -->
            <li>投稿された記事はありません</li>
            @endforelse
            <a href="{{ url()->previous() }}">戻る</a>
        </ul>
</x-layout>