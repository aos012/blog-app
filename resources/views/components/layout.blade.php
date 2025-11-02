<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="{{ url('bootstrap.php') }}">
</head>

<body>
    {{-- @include('layouts.navigation') --}}
    <!-- ユーザー認証関連挙動テスト用 -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
    <div class="container">
        {{ $slot }}
    </div>
</body>

</html>