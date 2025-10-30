<x-layout>
    <x-slot:title>
        新規記事作成・blog
        </x-slot>

        <h1>新規記事を作成</h1>
        <form method="post" action="{{ route('posts.store') }}">
            @csrf

            <div>
                <label>
                    タイトル
                    <input type="text" name="title" value="{{ old('title') }}">
                </label>
                @error('title')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>
                    本文を入力してください。
                    <textarea name="body">{{ old('body') }}</textarea>
                </label>
                @error('body')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button>投稿</button>
            </div>
        </form>
        <p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>
</x-layout>