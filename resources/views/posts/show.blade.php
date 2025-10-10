<x-layout>
    <x-slot:title>
        {{ $post->title }}・blog
    </x-slot>

    <h1>{{ $post->title }}</h1>
    <a href="{{ route('posts.edit', $post) }}">編集</a>
    <form method="post" action="{{ route('posts.destroy', $post) }}" class="delete-form">
        @method('DELETE')
        @csrf
        <button>記事を削除</button>
    </form>
    <p>{!!  nl2br(e($post->body)) !!}</p>

    <h2>コメント</h2>
        <ul>
            <!-- コメントをループで表示 -->
            @forelse ($post->comments as $comment)
                <li>{{ $comment->body }}
                    <form method="post" action="{{ route('posts.comments.destroy', [$post, $comment]) }}" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button>削除</button>
                    </form>
                </li>
            @empty <!-- コメントがない場合 -->
                <li>コメントがありません</li>
            @endforelse 
        </ul>

        <h2>コメントする</h2>
        <form method="post" action="{{ route('posts.comments.store', $post) }}">
            @csrf
            <input type="text" name="body">
            @error('body')
                <p class="error">{{ $message }}</p>
            @enderror
            <button>送信</button>
        </form>

    <p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>

    <script>
        'use strict';

        {
            //削除確認画面
            // const form = document.querySelector('#delete-form');
            // form.addEventListener('submit', (e) => {
            //     e.preventDefault();

            //     if (confirm('本当に削除しますか?') === false) {
            //         return;
            //     }

            //     form.submit();
            // });
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach((form) => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    if (confirm('本当に削除しますか？') === false) {
                        return;
                    }

                    form.submit();
                });
            });
        }
    </script>
</x-layout>