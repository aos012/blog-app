<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ url('bootstrap.php') }}">
</head>

<body>
    @auth
        <p>
            {{ Auth::user()->name }} ログイン中
        </p>
    @endauth
    <div class="container">
        {{ $slot }}
    </div>
</body>

</html>