@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/index.css')}}">
@endsection

@section('search')
<div class="store-search__group">
    <form class="store-search__form common-shadow" action="" method="">
        <div class="store-search__item">
            <select class="store-search__input" name="area-search" id="">
                <option value="" selected disabled>All area</option>
                @foreach($areas as $area)
                <option value="{{ $area['id'] }}" @if( old('area-search') ==  $area['id']) selected @endif>
                    {{ $area['name'] }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="store-search__item">
            <select class="store-search__input" name="genre-search" id="">
                <option value="" selected disabled>All genre</option>
                @foreach($genres as $genre)
                <option value="{{ $genre['id'] }}"
                @if( old('genre-search') ==  $genre['id']) selected @endif>
                    {{ $genre['name'] }}
                </option>
                @endforeach
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
    @foreach($shops as $shop)
    <div class="store-list__item common-shadow">
        <img class="store-list__img" src="{{ $shop['image_url'] }}" alt="店舗画像">
        <div class="store-list__text">
            <p class="store-list__name">
                {{ $shop['name'] }}
            </p>
            <div class="store-list__tag">
                <span class="store-list__area-tag">
                    #{{ $shop['area']['name'] }}
                </span>
                <span class="store-list__genre-tag">
                    #{{ $shop['genre']['name'] }}
                </span>
            </div>
            <div class="store-list__form">
                <form class="store-list__detail-form" action="/detail/{{ $shop['id']}}" method="get">
                    @csrf
                    <button class="common-btn store-list__detail-btn" type="submit">
                        詳しくみる
                    </button>
                </form>
                <img class="store-list__favorite" src="../images/heart.svg" alt="">
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection