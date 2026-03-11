<x-layout>
    <x-slot:title>
        プロフィール編集・blog
        </x-slot>

        <div class="container" style="max-width: 720px;">
            <h1>プロフィール編集</h1>
            <form method="post" action="{{ route('user.update', $user) }}">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        ユーザー名
                    </label>    
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" id="exampleFormControlInput1">
                    @error('name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        プロフィールを入力してください。
                    </label>        
                        <textarea name="profile" class="form-control" id="exampleFormControlTextarea1" rows="5
                    5">{{ old('profile', $user->profile) }}</textarea>
                    @error('profile')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex">
                    <p><a href="{{ route('user.show', ['user' => $user]) }}">戻る</a></p>
                    <div class="ms-4">
                        <button class="btn btn-primary">更新</button>
                    </div>
                </div>
            </form>
        </div>

</x-layout>