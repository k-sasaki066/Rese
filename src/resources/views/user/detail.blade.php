@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/detail.css')}}">
@endsection

@section('content')
<div class="store-detail__group">
    <div class="store-name__group">
        <a class="back__btn common-shadow" href="{{ $prev }}">
            <
        </a>
        <h2 class="store-name__text">
            {{ $shop['name'] }}
        </h2>
    </div>

    <div class="store-img__item">
        <img class="store-img" src="{{ $shop['image_url'] }}" alt="店舗画像">
    </div>

    <div class="store-tag__group">
        <p class="store__area-tag">
            #{{ $shop['area']['name'] }}
        </p>
        <p class="store__genre-tag">
            #{{ $shop['genre']['name'] }}
        </p>
    </div>

    <p class="store-content__text">
        {{ $shop['detail'] }}
    </p>
</div>

<div class="store-info__group">
    <h3>店舗詳細情報</h3>
    <table class="store-info__table">
        <tr class="store-info__table-row">
            <th class="store-info__table-header">
                住所
            </th>
            <td class="store-info__table-item">
                {{ $shop['address'] }}
                <br>
                {{ $shop['building'] }}
            </td>
        </tr>
        <tr class="store-info__table-row">
            <th class="store-info__table-header">
                電話番号
            </th>
            <td class="store-info__table-item">
                {{ $shop['tel'] }}
            </td>
        </tr>
        <tr class="store-info__table-row">
            <th class="store-info__table-header">
                営業時間
            </th>
            <td class="store-info__table-item">
                {{ substr($shop['opening_time'],0,5) }} 〜 {{ substr($shop['closing_time'],0,5) }}
                <br>
                定休日：
                @foreach($holidays as $holiday)
                {{ $holiday }}
                @endforeach
            </td>
        </tr>
        <tr class="store-info__table-row">
            <th class="store-info__table-header">
                席数
            </th>
            <td class="store-info__table-item">
                {{ $shop['max_number'] }}
            </td>
        </tr>
        <tr class="store-info__table-row">
            <th class="store-info__table-header">
                平均予算
            </th>
            <td class="store-info__table-item">
                ¥{{ number_format($shop['budget']) }}
            </td>
        </tr>
    </table>

    <h3>メニュー情報</h3>
    @if($shop['menus']->isEmpty())
    <p>メニューの登録がありません。</p>
    @else
    <table class="store-info__table">
        @foreach($shop['menus'] as $menu)
        <tr class="store-info__table-row">
            <th class="store-info__table-header">
                {{ $menu['name']}}
                <br>
                {{'¥' .number_format($menu['price'])}}
            </th>
            <td class="store-info__table-item">
                {{ $menu['detail'] }}
            </td>
        </tr>
        @endforeach
    </table>
    @endif
</div>

@livewire('reservation-form', ['option_times'=>$option_times,
'option_numbers'=>$option_numbers,
'shop'=>$shop])

<div class="store-rating__group">
    <div class="store-rating__heading">
        <h3>レビュー</h3>
        <span class="store-rating__count">全{{ $rating_count }}件</span>
    </div>

    @foreach($ratings as $rating)
    <div class="store-rating__item">
        <div class="rating__user">
            <img class="rating__user-img" src="../images/username.svg" alt="user">
            <p class="rating__user-name">{{ $rating['user']['name'] }}</p>
            <div class="rating__star-group">
                <span class="rating__star" data-rate="{{ $rating['rating'] }}">
            </div>
        </div>
        <div class="rating__comment-group">
            <p class="rating__comment-date">
                {{ substr($rating['reservation']['date'], 0,7) }}訪問
            </p>
            <p class="rating__comment-text">
                {{ $rating['comment'] }}
            </p>
        </div>
    </div>
    @endforeach
</div>

@endsection