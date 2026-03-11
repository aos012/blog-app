<x-layout>
    <x-slot:title>
        新規記事作成・blog
    </x-slot>

        <div class="container" style="max-width: 720px;">
            <h1>新規記事を作成</h1>
            <form method="post" action="{{ route('posts.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        タイトル
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="exampleFormControlInput1">
                    @error('title')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        本文を入力してください。
                    </label>
                    <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="18">{{ old('body') }}</textarea>

                    @error('body')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex">
                    <p><a href="{{ route('posts.index') }}">記事一覧に戻る</a></p>
                    <div class="ms-4"> 
                        <button class="btn btn-primary">投稿</button> 
                    </div> 
                </div>
            </form>
        </div>
</x-layout>