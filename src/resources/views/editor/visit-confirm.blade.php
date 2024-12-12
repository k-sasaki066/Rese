@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/editor/visit-confirm.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<div class="confirm-container common-shadow">
    <p class="thanks-text">
        ご来店ありがとうございます
    </p>

    <div class="reservation-info__group">
        <div class="reservation-info__item">
            <span class="reservation-info__item-span">
                名前
            </span>
            <p class="reservation-info__item-text">
                {{ $reservation['user']['name'] .'様' }}
            </p>
        </div>
        <div class="reservation-info__item">
            <span class="reservation-info__item-span">
                予約時間
            </span>
            <p class="reservation-info__item-text">
                {{ substr($reservation['time'], 0,5) }}
            </p>
        </div>
        <div class="reservation-info__item">
            <span class="reservation-info__item-span">
                予約人数
            </span>
            <p class="reservation-info__item-text">
                {{ $reservation['number'] .'人' }}
            </p>
        </div>
        <div class="reservation-info__item">
            <span class="reservation-info__item-span">
                支払い
            </span>
            <p class="reservation-info__item-text">
                {{ $reservation['payment'] == 1 ? '現地決済' : 'クレジットカード決済'}}
            </p>
        </div>
    </div>
    <a class="common-btn thanks__back-button" href="/">
        戻る
    </a>
</div>
@endsection