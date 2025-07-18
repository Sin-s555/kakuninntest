<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'アプリ名')</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">ホーム</a>

            @auth
                <span>{{ Auth::user()->name }} さん</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            @else
                <a href="{{ route('login') }}">ログイン</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
