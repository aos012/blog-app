<x-layout>
    <x-slot:title>
        {{ $post->title }}・blog
        </x-slot>

        <div class="container" style="max-width: 720px;">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ $post->title }}</h1>

                    <!-- 投稿者名、登校日時(更新日時)、ボタンを横並びにする -->
                    <div class="container d-flex">
                        <a href="{{ route('user.show', ['user' => $post->user]) }}">{{ $post->user->name }}</a>
                        <p class="ms-2">{{ $post->created_at }}</p>
                        <!-- もし記事が更新されていたら、更新日時も表示 -->
                        @if($post->created_at < $post->updated_at)
                            <p>({{ $post->updated_at }} 更新)</p>
                            @endif

                            @can('post-operation', $post)
                            <div class="button-container d-flex align-items-center ms-auto">
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-secondary btn-sm">
                                    編集
                                </a>
                                <form method="post" action="{{ route('posts.destroy', $post) }}" class="delete-form">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm ms-1">記事を削除</button>
                                </form>
                            </div>
                            @endcan
                    </div>
                    <!-- trueなら記事更新時メッセージ表示 -->
                    @if(session('message'))
                    {{ session('message')}}
                    @endif

                    <p class="card-text fs-5">{!! nl2br(e($post->body)) !!}</p>
                </div>
            </div>

            <p>
                <a href="{{ route('posts.index', ['post' => $post]) }}">一覧に戻る</a> /
                <a href="{{ route('user.show', ['user' => $post->user]) }}">{{ $post->user->name }}さんの記事一覧</a>
            </p>

            <h2>コメントする</h2>
            <form method="post" action="{{ route('posts.comments.store', $post) }}">
                @csrf
                <input type="text" name="body">
                <button class="btn btn-primary">送信</button>
                @error('body')
                <p class="error">{{ $message }}</p>
                @enderror
            </form>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="d-flex">
                        <h2 class="card-title">コメント一覧</h2>
                        <p class="m-1">( {{ $post->comments->count() }} )</p>
                    </div>

                    <ul>
                        <!-- コメントをループで表示 -->
                        @forelse ($post->comments as $comment)
                        <li class="mb-3">
                            <div class="border-bottom pb-3">
                                <span class="fs-5">{{ $comment->user->name }}</span> {{$comment->created_at }}

                                @can('comment-operation', $comment)
                                <form method="post" action="{{ route('posts.comments.destroy', [$post, $comment]) }}" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">削除</button>
                                </form>
                                @endcan
                                <br>
                                {!! nl2br(e($comment->body)) !!}
                            </div>
                        </li>
                        @empty <!-- コメントがない場合 -->
                        <li>コメントがありません</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>


        <script>
            'use strict';

            {
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