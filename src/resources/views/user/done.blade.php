@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css')}}">
@endsection

@section('content')
<div class="thanks-container common-shadow">
    <p class="thanks-text">
        ご予約ありがとうございます
    </p>
    <a class="common-btn thanks__back-button" href="/">
        戻る
    </a>
</div>
@endsection