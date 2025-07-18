@extends('layouts.default')

@section('content')

<a href="{{ route('register') }}" class="register-button">Register</a>

<div class="login-wrapper">
  <div class="login-container">
    

    <div class="login-box">
      {{-- ログインフォーム --}}
      <form action="{{ route('login') }}" method="POST" class="login-form" novalidate>
        @csrf

        <h2 class="login-title">Login</h2>

        {{-- ログイン失敗などのステータスメッセージ --}}
        @if (session('status'))
          <div class="error-message">
            {{ session('status') }}
          </div>
        @endif

        {{-- メールアドレス --}}
        <label for="email" class="form-label">メールアドレス</label>
        <input
          type="email"
          name="email"
          id="email"
          class="form-input"
          value="{{ old('email') }}"
          placeholder="例: test@example.com"
          @error('email') aria-invalid="true" @enderror
        >
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- パスワード --}}
        <label for="password" class="form-label">パスワード</label>
        <input
          type="password"
          name="password"
          id="password"
          class="form-input"
          placeholder="例: coachtech1106"
          @error('password') aria-invalid="true" @enderror
        >
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- ログインボタン --}}
        <div class="form-group">
          <button type="submit">ログイン</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
