<x-layout>
    <x-slot:title>
        記事編集・blog
        </x-slot>

        <h1>記事の編集</h1>
        <form method="post" action="{{ route('posts.update', $post) }}">
            @method('PATCH')
            @csrf

            <div>
                <label>
                    タイトル
                    <input type="text" name="title" value="{{ old('title', $post->title) }}">
                </label>
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>
                    本文を入力してください。
                    <textarea name="body">{{ old('body', $post->body) }}</textarea>
                </label>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button>更新</button>
            </div>
        </form>
        <p><a href="{{ route('posts.show', $post) }}">一覧に戻る</a></p>
</x-layout>