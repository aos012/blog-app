<x-layout>
    <x-slot:title>
        ユーザープロフィール・blog
        </x-slot>

        <h1>{{ $user->name }} <span style="font-size: 0.7em;">さん</span></h1>
        <!-- プロフィール更新時メッセージ表示 -->
        @if(session('message'))
        {{ session('message')}}
        @endif
        <!-- 本人のみプロフィール編集リンクを表示 -->
        <div class="my-2"> 
            @can('profile-edit', $user)
            <a href="{{ route('user.edit', $user) }}">プロフィールを編集</a>
            @endcan
        </div>

        <div class="card">
            <div class="card-body">
                @if ($user->profile)
                <p>{!! nl2br(e($user->profile)) !!}</p>
                @else <!-- プロフィール未記入の場合 -->
                <p>プロフィールは記入されていません</p>
                @endif
            </div>
        </div>

        <div class="my-3">
            <h2>投稿一覧</h2>
            <!-- 本人のみプロフィール編集・新規記事作成リンクを表示 -->
            @can('profile-edit', $user)
            <a href="{{ route('posts.create') }}">新しい投稿を作成</a>
            @endcan
            
            <div class="my-2">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th class="w-50">タイトル</th>
                            <th>投稿日</th>
                        </tr>
                    </thead>
                    <!-- 投稿をループで表示 -->
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td>
                                <a href="{{ route('posts.show', $post) }}" class="display: block text-reset text-decoration-none">    
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post) }}" class="display: block text-reset text-decoration-none">
                                    {{ $post->created_at }}
                                </a>
                            </td>

                            @empty <!-- 投稿がない場合 -->
                                <p>投稿された記事はありません</p>
                            @endforelse
                        </tr>
                    </tbody>
                </table>

                <div class="pegination">
                    {{ $posts->links() }}
                </div>
                <a href="{{ url()->previous() }}">戻る</a>
            </div>
        </div>

</x-layout>