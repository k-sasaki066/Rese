@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/index.css')}}">
@endsection

@section('search')
<div class="store-search__group">
    <form class="store-search__form" action="" method="">
        <div class="store-search__item">
            <select class="store-search__input" name="area-search" id="">
                <option value="" selected disabled>All area</option>
            </select>
        </div>

        <div class="store-search__item">
            <select class="store-search__input" name="genre-search" id="">
                <option value="" selected disabled>All genre</option>
            </select>
        </div>

        <div class="word-search__item">
            <img class="search-icon" src="../images/search.svg" alt="">
            <input class="word-search__input" type="text" name="word-search" placeholder="Search ...">
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="store-list__group">
    <div class="store-list__item">
        <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="">
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

    <div class="store-list__item">
        <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="">
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
    <div class="store-list__item">
        <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="">
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
    <div class="store-list__item">
        <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="">
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
    <div class="store-list__item">
        <img class="store-list__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="">
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

@endsection