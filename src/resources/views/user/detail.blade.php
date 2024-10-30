@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/detail.css')}}">
@endsection

@section('content')
<div class="store-detail__group">
    <div class="store-name__group">
        <a class="back__btn common-shadow" href="/">
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

<div class="reservation__group common-shadow">
    <form class="reservation-form" action="" method="">
        <p class="reservation__title">
            予約
        </p>

        <div class="reservation-form__item">
            <input class="reservation-form__date-input" type="date" name="date">

            <div class="reservation-form__select">
                <select class="reservation-form__input" name="time" id="">
                    <option value="" selected disabled>
                        来店時間を選択してください
                    </option>
                </select>
            </div>
            
            <div class="reservation-form__select">
                <select class="reservation-form__input" name="number" id="">
                    <option value="" selected disabled>
                        来店人数を選択してください
                    </option>
                </select>
            </div>
        </div>

        <div class="reservation-confirm__group">
            <table class="reservation-confirm__table">
                <tr class="reservation-confirm__table-row">
                    <th class="reservation-confirm__table-header">
                        Shop
                    </th>
                    <td class="reservation-confirm__table-item">
                        仙人
                    </td>
                </tr>

                <tr class="reservation-confirm__table-row">
                    <th class="reservation-confirm__table-header">
                        Date
                    </th>
                    <td class="reservation-confirm__table-item">
                        2024-11-01
                    </td>
                </tr>

                <tr class="reservation-confirm__table-row">
                    <th class="reservation-confirm__table-header">
                        Time
                    </th>
                    <td class="reservation-confirm__table-item">
                        17:00
                    </td>
                </tr>

                <tr class="reservation-confirm__table-row">
                    <th class="reservation-confirm__table-header">
                        Number
                    </th>
                    <td class="reservation-confirm__table-item">
                        4人
                    </td>
                </tr>
            </table>
        </div>
        <button class="reservation-form__submit" type="submit">
            予約する
        </button>
    </form>
</div>
@endsection