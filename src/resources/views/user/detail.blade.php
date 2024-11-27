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
</div>

@livewire('reservation-form', ['option_times'=>$option_times,
'option_numbers'=>$option_numbers,
'shop'=>$shop])

@endsection