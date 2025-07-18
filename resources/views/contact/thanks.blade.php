@extends('layouts.default')

@section('content')
<div class="thanks-wrapper">
  <div class="thanks-background">Thank you</div>
  <p class="thanks-message">お問い合わせありがとうございました</p>
  <a href="{{ route('contact.form') }}" class="home-button">HOME</a>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}?v={{ time() }}">
@endsection

