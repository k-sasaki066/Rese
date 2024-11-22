@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin-menu.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<div class="admin-menu__group">
    <h2 class="admin-menu__heading">
        店舗代表者専用画面
    </h2>
    <div class="admin-menu__link-group">
        <a class="admin-menu__item" href="/editor/shop/edit">店舗情報編集</a>
        <a class="admin-menu__item" href="/editor/shop/list">予約リスト</a>
    </div>
</div>
@endsection