<x-layout>
    <x-slot:title>
        {{ $post->title }}・blog
    </x-slot>

    <h1>{{ $post->title }}</h1>
    <a href="{{ route('posts.edit', $post) }}">編集</a>
    <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete-form">
        @method('DELETE')
        @csrf
        <button>記事を削除</button>
    </form>
    <p>{!!  nl2br(e($post->body)) !!}</p>
    <p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>

    <script>
        'use strict';

        {
            const form = document.querySelector('#delete-form');
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                if (confirm('本当に削除しますか?') === false) {
                    return;
                }

                form.submit();
            });

        }
    </script>
</x-layout>