@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<div class="thanks-container common-shadow">
    <p class="thanks-text">
        ご予約ありがとうございます
    </p>
    <a class="common-btn thanks__back-button" href="/mypage">
        戻る
    </a>
</div>
@endsection