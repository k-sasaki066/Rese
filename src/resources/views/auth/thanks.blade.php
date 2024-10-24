@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css')}}">
@endsection

@section('content')
<div class="thanks-container">
    <p class="thanks-text">
        会員登録ありがとうございます
    </p>
    <button class="common-btn thanks__login-button">
        ログインする
    </button>
</div>
@endsection