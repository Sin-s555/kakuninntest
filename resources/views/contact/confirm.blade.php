@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-wrapper">
  <h2 class="confirm-title">Confirm</h2>

  <form action="{{ route('contact.send') }}" method="POST">
    @csrf

    <table class="confirm-table">
      <tr>
        <th>お名前</th>
        <td>{{ $inputs['last_name'] ?? '' }}　{{ $inputs['first_name'] ?? '' }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>{{ $inputs['gender'] ?? '' }}</td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $inputs['email'] ?? '' }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $inputs['tel1'] ?? '' }}{{ $inputs['tel2'] ?? '' }}{{ $inputs['tel3'] ?? '' }}</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $inputs['address'] ?? '' }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $inputs['building'] ?? '' }}</td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $inputs['category'] ?? '' }}</td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{!! nl2br(e($inputs['content'] ?? '')) !!}</td>
      </tr>
    </table>

    {{-- hiddenで保持 --}}
    @foreach ($inputs as $name => $value)
      <input type="hidden" name="{{ $name }}" value="{{ e($value) }}">
    @endforeach

    <div class="confirm-buttons">
      <button type="submit" name="action" value="submit" class="send-button">送信</button>
      <button type="submit" name="action" value="back" class="back-button">修正</button>
    </div>
  </form>
</div>
@endsection
