<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', '管理画面')</title>

  {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
  @yield('css')

  @php
    use Illuminate\Support\Str;
  @endphp

  <style>
    body {
      font-size: 16px;
      margin: 5px;
    }
    h1 {
      font-size: 60px;
      color: white;
      text-shadow: 1px 0 5px #289ADC;
      letter-spacing: -4px;
      margin-left: 10px;
    }
    .header {
      position: relative;
      padding: 10px;
    }
    .logout-form {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .logout-button {
      background-color: #289ADC;
      color: white;
      border: none;
      padding: 8px 12px;
      font-size: 14px;
      border-radius: 4px;
      cursor: pointer;
    }
    .logout-button:hover {
      background-color: #1b6fa8;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1 class="site-title">FashionablyLate</h1>

    {{-- admin.* のルートのときだけログアウトボタンを表示 --}}
    @if (Str::startsWith(Route::currentRouteName(), 'admin.'))
      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="logout-button">logout</button>
      </form>
    @endif

     {{-- ページ個別のボタン（ログインなど） --}}
  @yield('header-buttons')
  </div>

  {{-- 必要に応じて追加のヘッダー --}}
  <div class="header-area">
    @yield('header')
  </div>

  {{-- メインコンテンツ --}}
  <div class="content">
    @yield('content')
  </div>

  {{-- JavaScriptなど --}}
  @yield('js')

</body>
</html>
