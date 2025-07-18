@extends('layouts.default')

@section('content')
<div class="contact-wrapper">

  <h2 class="contact-title">Contact</h2>

  <form action="{{ route('contact.confirm') }}" method="POST" class="contact-form">
    @csrf

    <div class="form-group row">
      <label>お名前 <span class="required">※</span></label>
      <div class="input-group">
        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
      </div>
      @error('last_name')
        <div class="error">{{ $message }}</div>
      @enderror
      @error('first_name')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group row">
      <label>性別 <span class="required">※</span></label>
      <div class="radio-group">
        <label><input type="radio" name="gender" value="男性" {{ old('gender', '男性') === '男性' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="女性" {{ old('gender') === '女性' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="その他" {{ old('gender') === 'その他' ? 'checked' : '' }}> その他</label>
      </div>
      @error('gender')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>メールアドレス <span class="required">※</span></label>
      <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
      @error('email')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group row">
      <label>電話番号 <span class="required">※</span></label>
      <div class="input-group">
        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
      </div>
      @error('tel1') <div class="error">{{ $message }}</div> @enderror
      @error('tel2') <div class="error">{{ $message }}</div> @enderror
      @error('tel3') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
      <label>住所 <span class="required">※</span></label>
      <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
      @error('address')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>建物名</label>
      <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
    </div>

    <div class="form-group">
      <label>お問い合わせの種類 <span class="required">※</span></label>
      <select name="category">
        <option value="">選択してください</option>
        <option value="交換" {{ old('category') === '交換' ? 'selected' : '' }}>商品の交換について</option>
        <option value="返品" {{ old('category') === '返品' ? 'selected' : '' }}>商品の返品について</option>
        <option value="その他" {{ old('category') === 'その他' ? 'selected' : '' }}>その他のお問い合わせ</option>
      </select>
      @error('category')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>お問い合わせ内容 <span class="required">※</span></label>
      <!-- maxlengthを外す -->
      <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
      @error('content')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group center">
      <button type="submit" class="confirm-button">確認画面</button>
    </div>
  </form>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection
