@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/index.css')}}">
<link rel="stylesheet" href="{{ asset('css/user/mypage.css')}}">
@endsection

@section('content')
<p class="user__name">
    {{ Auth::user()->name }}さん
</p>
<div class="mypage__container">
    <div class="reservation-status__group">
        <h2 class="reservation-status__title">
            予約状況
        </h2>

        <div class="reservation-status__content common-shadow">
            
            <div class="reservation-status__text">
                <img class="reservation-status__icon" src="../images/time.svg" alt="時計">
                <p class="reservation-status__number">
                    予約1
                </p>
                <form class="reservation-cancel__form" action="" method="">
                    <button class="reservation-cancel__btn">
                        <img class="reservation-cancel__btn-img" src="../images/close-btn.svg" alt="">
                    </button>
                </form>
            </div>

            <table class="reservation-status__table">
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Shop
                    </th>
                    <td class="reservation-status__table-item">
                        仙人
                    </td>
                </tr>
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Date
                    </th>
                    <td class="reservation-status__table-item">
                        2024-11-01
                    </td>
                </tr>
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Time
                    </th>
                    <td class="reservation-status__table-item">
                        17:00
                    </td>
                </tr>
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Number
                    </th>
                    <td class="reservation-status__table-item">
                        2人
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="favorite-store__list-group">
        <h2 class="favorite-store__list-title">
            お気に入り店舗
        </h2>

        <div class="favorite-store__list-content">
            <div class="store-list__item common-shadow">
                <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="店舗画像">
                <div class="store-list__text">
                    <p class="store-list__name">
                        らーめん極み
                    </p>
                    <div class="store-list__tag">
                        <span class="store-list__area-tag">
                        #東京都
                        </span>
                        <span class="store-list__genre-tag">
                            #イタリアン
                        </span>
                    </div>
                    <div class="store-list__form">
                        <button class="common-btn store-list__detail-btn">
                        詳しくみる
                        </button>
                        <img class="store-list__favorite" src="../images/heart.svg" alt="">
                    </div>
                </div>
            </div>

            <div class="store-list__item common-shadow">
                <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="店舗画像">
                <div class="store-list__text">
                    <p class="store-list__name">
                        らーめん極み
                    </p>
                    <div class="store-list__tag">
                        <span class="store-list__area-tag">
                        #東京都
                        </span>
                        <span class="store-list__genre-tag">
                            #イタリアン
                        </span>
                    </div>
                    <div class="store-list__form">
                        <button class="common-btn store-list__detail-btn">
                        詳しくみる
                        </button>
                        <img class="store-list__favorite" src="../images/heart.svg" alt="">
                    </div>
                </div>
            </div>

            <div class="store-list__item common-shadow">
                <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="店舗画像">
                <div class="store-list__text">
                    <p class="store-list__name">
                        らーめん極み
                    </p>
                    <div class="store-list__tag">
                        <span class="store-list__area-tag">
                        #東京都
                        </span>
                        <span class="store-list__genre-tag">
                            #イタリアン
                        </span>
                    </div>
                    <div class="store-list__form">
                        <button class="common-btn store-list__detail-btn">
                        詳しくみる
                        </button>
                        <img class="store-list__favorite" src="../images/heart.svg" alt="">
                    </div>
                </div>
            </div>

            <div class="store-list__item common-shadow">
                <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="店舗画像">
                <div class="store-list__text">
                    <p class="store-list__name">
                        らーめん極み
                    </p>
                    <div class="store-list__tag">
                        <span class="store-list__area-tag">
                        #東京都
                        </span>
                        <span class="store-list__genre-tag">
                            #イタリアン
                        </span>
                    </div>
                    <div class="store-list__form">
                        <button class="common-btn store-list__detail-btn">
                        詳しくみる
                        </button>
                        <img class="store-list__favorite" src="../images/heart.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection