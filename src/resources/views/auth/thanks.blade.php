@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css')}}">
@endsection

@section('content')
<div class="thanks-container common-shadow">
    <p class="thanks-text">
        会員登録ありがとうございます
    </p>
    <a class="common-btn thanks__login-button" href="/login">
        ログインする
    </a>
</div>
@endsection