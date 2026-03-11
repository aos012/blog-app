<x-layout>
    <x-slot:title>
        記事編集・blog
        </x-slot>

        <div class="container" style="max-width: 720px;">
            <h1>記事の編集</h1>
            <form method="post" action="{{ route('posts.update', $post) }}">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        タイトル
                    </label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" id="exampleFormControlInput1">
                    @error('title')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        本文を入力してください。
                    </label>
                        <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="18">{{ old('body', $post->body) }}</textarea>
                    @error('body')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex">
                    <p><a href="{{ route('posts.show', ['post' => $post]) }}">戻る</a></p>
                    <div class="ms-4">
                        <button class="btn btn-primary">更新</button>
                    </div>
                </div>
            </form>
        </div>
</x-layout>