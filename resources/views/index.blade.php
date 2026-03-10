<x-layout>
    <x-slot:title>
        blog
        </x-slot>
        <h1>記事一覧</h1>
        <!-- trueなら投稿or削除時メッセージ表示 -->
        @if(session('message'))
        {{ session('message')}}
        @endif
        <a href="{{ route('posts.create') }}">新しい投稿を作成</a>

        <div class="my-3">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th class="w-50">タイトル</th>
                        <th>投稿日</th>
                        <th>投稿者</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- 投稿をループで表示 -->
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
                        <td>
                            <a href="{{ route('posts.show', $post) }}" class="display: block text-reset text-decoration-none">{{ $post->user->name }}</a>
                        </td>
                    </tr>

                    @empty <!-- 投稿がない場合 -->
                    <p>投稿された記事はありません</p>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $posts->links() }}
        </div>
</x-layout>