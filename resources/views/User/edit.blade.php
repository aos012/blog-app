<x-layout>
    <x-slot:title>
        プロフィール編集・blog
        </x-slot>

        <h1>プロフィール編集</h1>
        <form method="post" action="{{ route('user.update', $user) }}">
            @method('PATCH')
            @csrf

            <div>
                <label>
                    ユーザー名
                    <input type="text" name="name" value="{{ old('name', $user->name) }}">
                </label>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>
                    プロフィールを入力してください。
                    <textarea name="profile">{{ old('profile', $user->profile) }}</textarea>
                </label>
                @error('profile')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button>更新</button>
            </div>
        </form>
        <p><a href="{{ route('user.show', $user) }}">戻る</a></p>
</x-layout>