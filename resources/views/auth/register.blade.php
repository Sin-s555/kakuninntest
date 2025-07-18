@extends('layouts.default')

@section('header-buttons')
  <a href="{{ route('login') }}" class="login-button">login</a>
@endsection

@section('content')
<div class="register-wrapper">
  <div class="register-container">
    {{-- 登録フォーム --}}
    <div class="register-box">
      <h2 class="register-title">Register</h2>

      @if(session('success'))
        <div style="color: green;">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('register') }}" method="POST" class="register-form">
        @csrf

        <label for="name" class="form-label">お名前</label>
        <input type="text" name="name" id="name" class="form-input" placeholder="例: 山田　太郎" value="{{ old('name') }}">
        @error('name')
          <div style="color: red;">{{ $message }}</div>
        @enderror

        <label for="email" class="form-label">メールアドレス</label>
        <input type="text" name="email" id="email" class="form-input" placeholder="例: test@example.com" value="{{ old('email') }}">
        @error('email')
          <div style="color: red;">{{ $message }}</div>
        @enderror

        <label for="password" class="form-label">パスワード</label>
        <input type="password" name="password" id="password" class="form-input" placeholder="例: coachtech1106">
        @error('password')
          <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit" class="register-button">登録</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
